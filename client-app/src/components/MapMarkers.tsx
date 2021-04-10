import * as Location from 'expo-location'
import React from 'react'
import { StyleSheet, View } from 'react-native'
import { Circle, Marker } from 'react-native-maps'
import BlockadeIcon from '../../assets/block.svg'
import CheckpointIcon from '../../assets/checkpoint.svg'
import TransportIcon from '../../assets/transport.svg'
import { colors } from '../theme'

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
})

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
const TransportMarker: React.FC<TransportMarkerProps> = ({ location }) => (
  <Marker
    coordinate={{
      latitude: location.coords.latitude,
      longitude: location.coords.longitude,
    }}
  >
    <View style={containerStyle()}>
      <TransportIcon {...ICON_SIZE} />
    </View>
  </Marker>
)

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
  let color: keyof typeof colors = 'midGray'

  const occupancy = people_count / capacity
  const inRange = (range: [number, number]) =>
    occupancy >= range[0] && occupancy <= range[1]

  if (occupancy > 0.9) color = 'red'
  if (inRange([0.71, 0.9])) color = 'orange'
  if (inRange([0.4, 0.7])) color = 'yellow'
  if (occupancy < 0.4) color = 'green'

  return (
    <Marker
      coordinate={{
        latitude: location.coords.latitude,
        longitude: location.coords.longitude,
      }}
    >
      <View style={containerStyle(color)}>
        <CheckpointIcon {...ICON_SIZE} style={styles.checkpointIcon} />
      </View>
    </Marker>
  )
}

const BlockadeMarker: React.FC<{ location: Location.LocationObject }> = ({
  location,
}) => (
  <Marker
    coordinate={{
      latitude: location.coords.latitude,
      longitude: location.coords.longitude,
    }}
  >
    <View style={containerStyle('yellow')}>
      <BlockadeIcon {...ICON_SIZE} />
    </View>
  </Marker>
)

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
