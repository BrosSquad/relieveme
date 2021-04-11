import { NavigationContainer, useNavigation } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
import { Subscription } from '@unimodules/core'
import * as Location from 'expo-location'
import * as Notifications from 'expo-notifications'
import React from 'react'
import 'react-native-gesture-handler'
import { NotificationPayload, useNotification } from './hooks/useNotification'
import { useRegisterUser } from './hooks/useRegisterUser'
import AlertScreen from './screens/AlertScreen'
import HazardMap from './screens/HazardMap'
import WelcomeScreen from './screens/WelcomeScreen'
import getUserLocation from './utils/getUserLocation'
import registerForPushNotificationsAsync from './utils/registerForPushNotificationsAsync'

Notifications.setNotificationHandler({
  handleNotification: async () => ({
    shouldShowAlert: true,
    shouldPlaySound: false,
    shouldSetBadge: false,
  }),
})

export enum AppRoutes {
  Root = 'App',
  Welcome = 'App/Welcome',
  Alert = 'App/Alert',
  HazardMap = 'Hazard/Map',
}

const AppStack = createStackNavigator()
const AppNavigator: React.FC = () => {
  const navigation = useNavigation()
  const { setNotification } = useNotification()
  const [expoPushToken, setExpoPushToken] = React.useState<string>()
  const notificationListener = React.useRef<Subscription>()
  const responseListener = React.useRef<Subscription>()

  React.useEffect(() => {
    registerForPushNotificationsAsync().then((token) => setExpoPushToken(token))
    notificationListener.current = Notifications.addNotificationReceivedListener(
      (notification) => {
        const payload = notification.request.content.data as NotificationPayload
        setNotification(payload)
        if (payload.type === 'hazard') {
          navigation.navigate(AppRoutes.Alert)
        }
      },
    )

    responseListener.current = Notifications.addNotificationResponseReceivedListener(
      (response) => {
        const payload = response.notification.request.content
          .data as NotificationPayload
        if (payload.type === 'hazard') {
          navigation.navigate(AppRoutes.Alert)
        }
      },
    )

    return () => {
      if (notificationListener.current && responseListener.current) {
        Notifications.removeNotificationSubscription(
          notificationListener.current,
        )
        Notifications.removeNotificationSubscription(responseListener.current)
      }
    }
  }, [navigation, setNotification])

  const { registerUser } = useRegisterUser()
  const [location, setLocation] = React.useState<Location.LocationObject>()

  React.useEffect(() => {
    getUserLocation().then((location) => location && setLocation(location))
  }, [])

  React.useEffect(() => {
    if (expoPushToken && location) {
      registerUser(expoPushToken, location)
    }
  }, [expoPushToken, location, registerUser])

  return (
    <AppStack.Navigator
      initialRouteName={AppRoutes.Welcome}
      screenOptions={{ headerShown: false }}
    >
      <AppStack.Screen name={AppRoutes.Welcome} component={WelcomeScreen} />
      <AppStack.Screen name={AppRoutes.Alert} component={AlertScreen} />
      <AppStack.Screen name={AppRoutes.HazardMap} component={HazardMap} />
    </AppStack.Navigator>
  )
}

const RootStack = createStackNavigator()
const RootNavigator: React.FC = () => {
  return (
    <NavigationContainer>
      <RootStack.Navigator screenOptions={{ headerShown: false }}>
        <RootStack.Screen component={AppNavigator} name={AppRoutes.Root} />
      </RootStack.Navigator>
    </NavigationContainer>
  )
}

export default RootNavigator
