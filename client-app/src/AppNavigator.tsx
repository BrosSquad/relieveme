import { NavigationContainer } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
import React from 'react'
import AlertScreen from './screens/AlertScreen'
import HazardMap from './screens/HazardMap'
import WelcomeScreen from './screens/WelcomeScreen'

const Stack = createStackNavigator()

const AppNavigator: React.FC = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Welcome">
        <Stack.Screen
          name="Welcome"
          component={WelcomeScreen}
          options={{
            headerShown: false,
          }}
        />
        <Stack.Screen
          name="Alert"
          component={AlertScreen}
          options={{
            headerShown: false,
          }}
        />
        <Stack.Screen
          name="HazardMap"
          component={HazardMap}
          options={{
            headerShown: false,
          }}
        />
      </Stack.Navigator>
    </NavigationContainer>
  )
}

export default AppNavigator
