import { NavigationContainer, useNavigation } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
import { Subscription } from '@unimodules/core'
import * as Notifications from 'expo-notifications'
import React from 'react'
import 'react-native-gesture-handler'
import { AppRoutes } from './AppRoutes'
import { NotificationPayload, useNotification } from './hooks/useNotification'
import AlertScreen from './screens/AlertScreen'
import CheckpointDetailsScreen from './screens/CheckpointDetailsScreen'
import HazardMap from './screens/HazardMap'
import QRScanScreen from './screens/QRScanScreen'
import SafetySuggestionsScreen from './screens/SafetySuggestionsScreen'
import TransportDetailsScreen from './screens/TransportDetailsScreen'
import WelcomeScreen from './screens/WelcomeScreen'
import { typography } from './theme'

Notifications.setNotificationHandler({
  handleNotification: async () => ({
    shouldShowAlert: true,
    shouldPlaySound: false,
    shouldSetBadge: false,
  }),
})

const AppStack = createStackNavigator()
const AppNavigator: React.FC = () => {
  const navigation = useNavigation()
  const { setNotification } = useNotification()
  const notificationListener = React.useRef<Subscription>()
  const responseListener = React.useRef<Subscription>()

  React.useEffect(() => {
    notificationListener.current = Notifications.addNotificationReceivedListener(
      (notification) => {
        const payload = notification.request.content.data as NotificationPayload
        if (payload.type === 'hazard') {
          setNotification(payload)
          navigation.navigate(AppRoutes.Alert)
        }
      },
    )

    responseListener.current = Notifications.addNotificationResponseReceivedListener(
      (response) => {
        const payload = response.notification.request.content
          .data as NotificationPayload
        if (payload.type === 'hazard') {
          setNotification(payload)
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

  return (
    <AppStack.Navigator
      initialRouteName={AppRoutes.Welcome}
      screenOptions={{ headerShown: false }}
    >
      <AppStack.Screen name={AppRoutes.Welcome} component={WelcomeScreen} />
      <AppStack.Screen name={AppRoutes.Alert} component={AlertScreen} />
      <AppStack.Screen name={AppRoutes.HazardMap} component={HazardMap} />
      <AppStack.Screen name={AppRoutes.QRScan} component={QRScanScreen} />
      <AppStack.Screen
        name={AppRoutes.Suggestions}
        component={SafetySuggestionsScreen}
      />
      <AppStack.Screen
        name={AppRoutes.CheckpointDetails}
        component={CheckpointDetailsScreen}
        options={({ route }) => ({
          headerShown: true,
          headerTitleStyle: typography.title3Emphasized,
          headerBackTitleStyle: typography.bodyEmphasized,
          headerTitle: route.params?.name,
        })}
      />
      <AppStack.Screen
        name={AppRoutes.TransportDetails}
        component={TransportDetailsScreen}
        options={({ route }) => ({
          headerShown: true,
          headerTitleStyle: typography.title3Emphasized,
          headerBackTitleStyle: typography.bodyEmphasized,
          headerTitle: route.params?.type,
        })}
      />
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
