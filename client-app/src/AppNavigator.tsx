import { NavigationContainer } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
import React from 'react'
import { SafeAreaView, StatusBar, Text, View } from 'react-native'
import AlertScreen from './screens/AlertScreen'

const HomeScreen: React.FC = () => (
  <SafeAreaView>
    <StatusBar barStyle="dark-content" />
    <View>
      <Text>HomeScreen</Text>
    </View>
  </SafeAreaView>
)

const Stack = createStackNavigator()

const AppNavigator: React.FC = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Alert">
        <Stack.Screen
          name="Home"
          component={HomeScreen}
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
      </Stack.Navigator>
    </NavigationContainer>
  )
}

export default AppNavigator
