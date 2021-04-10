import { Subscription } from '@unimodules/core'
import * as Notifications from 'expo-notifications'
import React from 'react'
import 'react-native-gesture-handler'
import { enableScreens } from 'react-native-screens'
import AppNavigator from './src/AppNavigator'
import registerForPushNotificationsAsync from './src/registerForPushNotificationsAsync'
import registerUserLocation from './src/registerUserLocation'

enableScreens()

Notifications.setNotificationHandler({
  handleNotification: async () => ({
    shouldShowAlert: true,
    shouldPlaySound: false,
    shouldSetBadge: false,
  }),
})

export default function App() {
  const [expoPushToken, setExpoPushToken] = React.useState<string>()
  const [
    notification,
    setNotification,
  ] = React.useState<Notifications.Notification>()
  const notificationListener = React.useRef<Subscription>()
  const responseListener = React.useRef<Subscription>()

  // Setup notifications
  React.useEffect(() => {
    registerForPushNotificationsAsync().then((token) => setExpoPushToken(token))

    notificationListener.current = Notifications.addNotificationReceivedListener(
      (notification) => {
        setNotification(notification)
      },
    )

    responseListener.current = Notifications.addNotificationResponseReceivedListener(
      (response) => {
        console.log(response)
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
  }, [])

  React.useEffect(() => {
    registerUserLocation()
  }, [])

  return <AppNavigator />
}
