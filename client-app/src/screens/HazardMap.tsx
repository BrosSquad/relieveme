import * as Location from 'expo-location'
import { LocationAccuracy } from 'expo-location'
import React from 'react'
import {
  ActivityIndicator,
  Dimensions,
  Platform,
  StatusBar,
  StyleSheet,
  View,
} from 'react-native'
import MapView from 'react-native-maps'
import BottomSheet from 'reanimated-bottom-sheet'
import ReportBlockadeIcon from '../../assets/report-blockade.svg'
import * as API from '../API'
import BlockadeForm from '../components/BlockadeForm'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import MapMarkers from '../components/MapMarkers'
import { useNotification } from '../hooks/useNotification'
import { colors } from '../theme'

const SHEET_HEIGHT = 600

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

  const { notification } = useNotification()
  const [hazard, setHazard] = React.useState<API.Hazard>()
  const [blockades, setBlockades] = React.useState<API.Blocade[]>([])
  const [checkpoints, setCheckpoints] = React.useState<API.Checkpoint[]>([])
  const [transports, setTransports] = React.useState<API.Transport[]>([])

  const loadMapData = React.useCallback(async () => {
    if (!notification) return
    const { data } = await API.getMapData(notification.id)

    setBlockades(data.blocades)
    setCheckpoints(data.checkpoints)
    setTransports(data.transports)
    setHazard(data.hazard)
  }, [notification])

  React.useEffect(() => {
    loadMapData()
  }, [loadMapData])

  const sheetRef = React.useRef<BottomSheet>(null)
  const [isSheetOpen, setSheetOpen] = React.useState(false)
  const handleBlockadeSubmit = (description: string) => {
    console.log(description)
    setSheetOpen(false)
  }
  React.useEffect(() => {
    if (sheetRef.current) {
      isSheetOpen ? sheetRef.current.snapTo(0) : sheetRef.current.snapTo(1)
    }
  }, [isSheetOpen])

  return (
    <View style={styles.container}>
      <StatusBar
        barStyle={Platform.select({
          ios: 'dark-content',
          android: 'light-content',
        })}
      />
      {!isSheetOpen && (
        <FABContainer position="bottom-right">
          <FAB color="orange" onPress={() => setSheetOpen(true)}>
            <ReportBlockadeIcon />
          </FAB>
        </FABContainer>
      )}
      <BottomSheet
        ref={sheetRef}
        snapPoints={[SHEET_HEIGHT, 0]}
        borderRadius={32}
        renderContent={() => <BlockadeForm onSubmit={handleBlockadeSubmit} />}
        onCloseEnd={() => setSheetOpen(false)}
      />

      {!location ? (
        <ActivityIndicator color={colors.black} />
      ) : (
        <MapView
          style={StyleSheet.absoluteFillObject}
          initialRegion={{
            latitude: location.coords.latitude,
            longitude: location.coords.longitude,
            latitudeDelta: 0.0043,
            longitudeDelta: 0.0034,
          }}
        >
          <MapMarkers.Me
            coordinate={{
              longitude: location.coords.longitude,
              latitude: location.coords.latitude,
            }}
          />
          {hazard && (
            <MapMarkers.HazardCircle
              radius={hazard.radius}
              coordinate={{
                longitude: hazard.location.coordinates[0],
                latitude: hazard.location.coordinates[1],
              }}
            />
          )}
          {checkpoints.map(
            ({ id, people_count, capacity, location, name, helps }) => (
              <MapMarkers.Checkpoint
                key={id}
                peopleCount={people_count}
                capacity={capacity}
                name={name}
                helps={helps}
                coordinate={{
                  longitude: location.coordinates[0],
                  latitude: location.coordinates[1],
                }}
              />
            ),
          )}
          {transports.map(({ id, type, description, location }) => (
            <MapMarkers.Transport
              key={id}
              type={type}
              description={description}
              coordinate={{
                longitude: location.coordinates[0],
                latitude: location.coordinates[1],
              }}
            />
          ))}
          {blockades.map(({ id, name, location }) => (
            <MapMarkers.Blockade
              key={id}
              name={name}
              coordinate={{
                longitude: location.coordinates[0],
                latitude: location.coordinates[1],
              }}
            />
          ))}
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
