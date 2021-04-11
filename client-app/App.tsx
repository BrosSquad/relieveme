import * as Location from 'expo-location'
import React from 'react'
import { LogBox } from 'react-native'
import 'react-native-gesture-handler'
import { enableScreens } from 'react-native-screens'
import RootNavigator from './src/AppNavigator'
import { HazardMapProvider } from './src/hooks/useHazardMapSubscription'
import { NotificationProvider } from './src/hooks/useNotification'

LogBox.ignoreAllLogs(true)
enableScreens()

Location.setGoogleApiKey('AIzaSyB7EReKu7AC70emJ6y-lZGTXcj-_fq1kw4')

export default function App() {
  return (
    <NotificationProvider>
      <HazardMapProvider>
        <RootNavigator />
      </HazardMapProvider>
    </NotificationProvider>
  )
}
