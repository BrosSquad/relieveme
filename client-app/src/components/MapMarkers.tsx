import * as Location from 'expo-location'
import React from 'react'
import { StyleSheet, Text, View } from 'react-native'
import { Callout, Circle, Marker } from 'react-native-maps'
import { colors, typography } from '../theme'

const MARKER_SIZE = 72
const ICON_SIZE = { width: MARKER_SIZE * 0.5, height: MARKER_SIZE * 0.5 }
const containerStyle = (color: keyof typeof colors = 'midGray') => {
  const { container } = StyleSheet.create({
    // eslint-disable-next-line react-native/no-unused-styles
    container: {
      backgroundColor: colors.white,
      width: MARKER_SIZE,
      height: MARKER_SIZE,
      padding: 6,
      borderRadius: 76,
      borderColor: colors[color],
      borderWidth: 5,
      alignItems: 'center',
      justifyContent: 'center',
    },
  })
  return container
}
const styles = StyleSheet.create({
  checkpointIcon: { marginLeft: 4 },
  calloutContainer: {
    maxWidth: 150,
  },
  calloutTitle: {
    textAlign: 'center',
    marginBottom: 3,
  },
  calloutText: {
    textAlign: 'center',
  },
})

const useCallout = () => {
  const ref = React.useRef<Marker>(null)

  const [isCalloutVisible, setCalloutVisible] = React.useState(false)
  const toggle = () => setCalloutVisible((prev) => !prev)

  React.useEffect(() => {
    if (ref.current) {
      isCalloutVisible ? ref.current.hideCallout() : ref.current.showCallout()
    }
  }, [isCalloutVisible])

  return {
    ref,
    toggle,
    isCalloutVisible,
  }
}

const MeMarker: React.FC<{ location: Location.LocationObject }> = ({
  location,
}) => (
  <Marker
    coordinate={{
      latitude: location.coords.latitude,
      longitude: location.coords.longitude,
    }}
  />
)

type TransportMarkerProps = {
  location: Location.LocationObject
}
const TransportMarker: React.FC<TransportMarkerProps> = ({ location }) => {
  const { ref, toggle } = useCallout()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-transport.png')}
      coordinate={{
        latitude: location.coords.latitude,
        longitude: location.coords.longitude,
      }}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            Vojni helikopter
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            20:00 - 20:15
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            Kod ulaza u park
          </Text>
        </View>
      </Callout>
    </Marker>
  )
}

type CheckpointMarkerProps = {
  location: Location.LocationObject
  people_count: number
  capacity: number
}
const CheckpointMarker: React.FC<CheckpointMarkerProps> = ({
  location,
  people_count,
  capacity,
}) => {
  const { ref, toggle } = useCallout()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-checkpoint.png')}
      coordinate={{
        latitude: location.coords.latitude,
        longitude: location.coords.longitude,
      }}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            Crveni krst I
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            Skloniste, hrana
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            Zauzeto {people_count} od {capacity} mesta
          </Text>
        </View>
      </Callout>
    </Marker>
  )
}

const BlockadeMarker: React.FC<{
  location: Location.LocationObject
  description: string
}> = ({ location, description }) => {
  const { ref, toggle } = useCallout()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-blockade.png')}
      coordinate={{
        latitude: location.coords.latitude,
        longitude: location.coords.longitude,
      }}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            Blokada
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            {description}
          </Text>
        </View>
      </Callout>
    </Marker>
  )
}

type HazardCircleProps = {
  latitude: number
  longitude: number
  radius: number
}
const HazardCircle: React.FC<HazardCircleProps> = ({
  latitude,
  longitude,
  radius,
}) => (
  <Circle
    radius={radius}
    center={{
      latitude,
      longitude,
    }}
    strokeWidth={2}
    strokeColor={colors.red}
    fillColor="rgba(231, 77, 60, 0.212)"
  />
)

const MapMarkers = {
  Me: MeMarker,
  Transport: TransportMarker,
  Checkpoint: CheckpointMarker,
  Blockade: BlockadeMarker,
  HazardCircle,
} as const

export default MapMarkers
