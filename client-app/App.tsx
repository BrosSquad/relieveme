import React from 'react'
import 'react-native-gesture-handler'
import { enableScreens } from 'react-native-screens'
import AppNavigator from './src/AppNavigator'

enableScreens()

export default function App() {
  return <AppNavigator />
}
