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
import BottomSheet from 'reanimated-bottom-sheet'
import ReportBlockadeIcon from '../../assets/report-blockade.svg'
import BlockadeForm from '../components/BlockadeForm'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import MapMarkers from '../components/MapMarkers'
import { colors } from '../theme'

const SHEET_HEIGHT = 600

const HazardMap: React.FC = () => {
  const [location, setLocation] = React.useState<Location.LocationObject>()
  const [isSheetOpen, setSheetOpen] = React.useState(false)
  const sheetRef = React.useRef<BottomSheet>(null)

  const watchUserLocation = async () => {
    await Location.watchPositionAsync(
      { accuracy: LocationAccuracy.Highest },
      (location) => {
        setLocation(location)
      },
    )
  }

  const handleBlockadeSubmit = (description: string) => {
    console.log(description)
    setSheetOpen(false)
  }

  React.useEffect(() => {
    watchUserLocation()
  }, [])

  React.useEffect(() => {
    if (sheetRef.current) {
      isSheetOpen ? sheetRef.current.snapTo(0) : sheetRef.current.snapTo(1)
    }
  }, [isSheetOpen])

  return (
    <View style={styles.container}>
      <StatusBar barStyle="dark-content" />
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
          style={styles.map}
          initialRegion={{
            latitude: location.coords.latitude,
            longitude: location.coords.longitude,
            latitudeDelta: 0.0043,
            longitudeDelta: 0.0034,
          }}
        >
          <MapMarkers.Blockade
            location={location}
            description="Urusila se zgrada, put je blokiran u oba smera!"
          />
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
