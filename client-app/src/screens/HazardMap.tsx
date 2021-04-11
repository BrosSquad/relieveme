import { useNavigation } from '@react-navigation/core'
import * as Location from 'expo-location'
import { LocationAccuracy } from 'expo-location'
import React from 'react'
import {
  ActivityIndicator,
  Platform,
  StatusBar,
  StyleSheet,
  View,
} from 'react-native'
import MapView, { MapEvent } from 'react-native-maps'
import BottomSheet from 'reanimated-bottom-sheet'
import QRCodeIcon from '../../assets/qr-code.svg'
import ReportBlockadeIcon from '../../assets/report-blockade.svg'
import * as API from '../API'
import { AppRoutes } from '../AppRoutes'
import BlockadeForm from '../components/BlockadeForm'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import MapMarkers from '../components/MapMarkers'
import useHazardMapSubscription from '../hooks/useHazardMapSubscription'
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

  const {
    blockades,
    checkpoints,
    hazard,
    transports,
    subcribeToMapUpdates,
    listenForChanges,
    loadMapData,
  } = useHazardMapSubscription()

  React.useEffect(() => {
    subcribeToMapUpdates()
  }, [subcribeToMapUpdates])
  React.useEffect(() => {
    listenForChanges()
  }, [listenForChanges])
  React.useEffect(() => {
    loadMapData()
  }, [loadMapData])

  const sheetRef = React.useRef<BottomSheet>(null)
  const [isSheetOpen, setSheetOpen] = React.useState(false)
  const [selectedLocation, setSelectedLocation] = React.useState<{
    longitude: number
    latitude: number
  }>()

  const handlePress = (e: MapEvent) => {
    setSelectedLocation(e.nativeEvent.coordinate)
  }

  const handleBlockadeSubmit = async (description: string) => {
    if (!selectedLocation || !hazard) return
    try {
      const response = await API.reportNewBlockade(
        description,
        selectedLocation,
        hazard.id,
      )
      console.log(response)
    } catch (err) {
      console.log(err)
    }
    setSheetOpen(false)
  }
  React.useEffect(() => {
    if (sheetRef.current) {
      isSheetOpen ? sheetRef.current.snapTo(0) : sheetRef.current.snapTo(1)
    }
  }, [isSheetOpen])

  const navigation = useNavigation()

  console.log('User Location', location?.coords)

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
          <FAB
            color="purple"
            onPress={() => navigation.navigate(AppRoutes.QRScan)}
          >
            <QRCodeIcon />
          </FAB>
          <FAB color="orange" onPress={() => setSheetOpen(true)}>
            <ReportBlockadeIcon />
          </FAB>
        </FABContainer>
      )}
      <BottomSheet
        ref={sheetRef}
        snapPoints={[SHEET_HEIGHT, 0]}
        borderRadius={32}
        renderContent={() => (
          <BlockadeForm
            onSubmit={(description) => handleBlockadeSubmit(description)}
          />
        )}
        onCloseEnd={() => setSheetOpen(false)}
      />

      {!location ? (
        <ActivityIndicator color={colors.black} />
      ) : (
        <MapView
          style={StyleSheet.absoluteFillObject}
          onDoublePress={handlePress}
          initialRegion={{
            latitude: location.coords.latitude,
            longitude: location.coords.longitude,
            latitudeDelta: 0.0043,
            longitudeDelta: 0.0034,
          }}
        >
          {selectedLocation && (
            <MapMarkers.Blockade
              defaultOpen={true}
              name="Blokada"
              coordinate={selectedLocation}
            />
          )}
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
          {checkpoints.map((checkpoint) => (
            <MapMarkers.Checkpoint
              onPress={() => {
                navigation.navigate(AppRoutes.CheckpointDetails, checkpoint)
              }}
              key={`${checkpoint.id}-c`}
              peopleCount={checkpoint.people_count}
              capacity={checkpoint.capacity}
              name={checkpoint.name}
              helps={checkpoint.helps}
              coordinate={{
                longitude: checkpoint.location.coordinates[0],
                latitude: checkpoint.location.coordinates[1],
              }}
            />
          ))}
          {transports.map((transport) => (
            <MapMarkers.Transport
              onPress={() => {
                navigation.navigate(AppRoutes.TransportDetails, transport)
              }}
              key={`${transport.id}-t`}
              type={transport.type}
              description={transport.description}
              coordinate={{
                longitude: transport.location.coordinates[0],
                latitude: transport.location.coordinates[1],
              }}
            />
          ))}
          {blockades.map(({ id, name, location }) => (
            <MapMarkers.Blockade
              key={`${id}-b`}
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
})

export default HazardMap
