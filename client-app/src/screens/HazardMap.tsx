import * as Location from 'expo-location'
import { LocationAccuracy } from 'expo-location'
import React from 'react'
import {
  ActivityIndicator,
  Dimensions,
  StatusBar,
  StyleSheet,
  View,
} from 'react-native'
import MapView from 'react-native-maps'
import MapMarkers from '../components/MapMarkers'
import { colors } from '../theme'

const HazardMap: React.FC = () => {
  const [location, setLocation] = React.useState<Location.LocationObject>()

  const watchUserLocation = async () => {
    await Location.watchPositionAsync(
      { accuracy: LocationAccuracy.Highest },
      (location) => {
        setLocation(location)
      },
    )
  }

  React.useEffect(() => {
    watchUserLocation()
  }, [])

  return (
    <View style={styles.container}>
      <StatusBar barStyle="dark-content" />
      {!location ? (
        <ActivityIndicator color={colors.black} />
      ) : (
        <MapView
          style={styles.map}
          initialRegion={{
            latitude: location.coords.latitude,
            longitude: location.coords.longitude,
            latitudeDelta: 0.0043,
            longitudeDelta: 0.0034,
          }}
        >
          <MapMarkers.Me location={location} />
        </MapView>
      )}
    </View>
  )
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  map: {
    width: Dimensions.get('window').width,
    height: Dimensions.get('window').height,
  },
})

export default HazardMap
