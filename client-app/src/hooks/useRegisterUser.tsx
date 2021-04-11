import AsyncStorage from '@react-native-async-storage/async-storage'
import * as Location from 'expo-location'
import * as API from '../API'

export function useRegisterUser() {
  const registerUser = async (
    expoToken: string,
    location: Location.LocationObject,
  ) => {
    try {
      const { data } = await API.register(expoToken, {
        lat: location.coords.latitude,
        lng: location.coords.longitude,
      })

      await AsyncStorage.setItem('@userToken', data.token)
    } catch (error) {
      console.log('Register Error', error)
    }
  }
  const getUserToken = async () => {
    const userToken = await AsyncStorage.getItem('@userToken')
    return userToken
  }

  return {
    registerUser,
    getUserToken,
  }
}
