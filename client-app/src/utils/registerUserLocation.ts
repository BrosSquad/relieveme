import * as Location from 'expo-location'

export default async function registerUserLocation() {
  const { status } = await Location.requestPermissionsAsync()
  if (status !== 'granted') {
    alert('Permission to access location was denied')
    return
  }

  const location = await Location.getCurrentPositionAsync({})
  console.log(location)
  // send to API
}
