import React from 'react'
import 'react-native-gesture-handler'
import { enableScreens } from 'react-native-screens'
import RootNavigator from './src/AppNavigator'
import { NotificationProvider } from './src/hooks/useNotification'

enableScreens()

export default function App() {
  return (
    <NotificationProvider>
      <RootNavigator />
    </NotificationProvider>
  )
}
