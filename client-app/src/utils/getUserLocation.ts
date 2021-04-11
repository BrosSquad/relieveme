import * as Location from 'expo-location'

export default async function getUserLocation() {
  const { status } = await Location.requestPermissionsAsync()
  if (status !== 'granted') {
    alert('Permission to access location was denied')
    return
  }

  return Location.getCurrentPositionAsync({
    accuracy: Location.Accuracy.Highest,
  })
}
