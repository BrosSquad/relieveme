import AsyncStorage from '@react-native-async-storage/async-storage'
import * as Location from 'expo-location'
import * as API from '../API'

const STORAGE_KEY = '@userToken'
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

      await AsyncStorage.setItem(STORAGE_KEY, data[0].token)
    } catch (error) {
      if (error.response.status === 422) {
        console.log('User already registered, skipping.')
      }
    }
  }
  const getUserToken = async () => {
    const userToken = await AsyncStorage.getItem(STORAGE_KEY)
    return userToken
  }

  return {
    registerUser,
    getUserToken,
  }
}
