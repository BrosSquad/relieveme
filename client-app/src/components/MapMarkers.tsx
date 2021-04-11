import React from 'react'
import { StyleSheet, Text, View } from 'react-native'
import { Callout, Circle, Marker } from 'react-native-maps'
import { Help, TransportType } from '../API'
import useCallout from '../hooks/useMarkerCallout'
import { colors, typography } from '../theme'

type BaseMarkerProps = {
  coordinate: {
    latitude: number
    longitude: number
  }
}

const MeMarker: React.FC<BaseMarkerProps> = ({ coordinate }) => (
  <Marker image={require('../../assets/pin-me.png')} coordinate={coordinate} />
)

type TransportMarkerProps = {
  type: TransportType
  description: string
}
const TransportMarker: React.FC<TransportMarkerProps & BaseMarkerProps> = ({
  coordinate,
  type,
  description,
}) => {
  const { ref, toggle } = useCallout()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-transport.png')}
      coordinate={coordinate}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            {type.toUpperCase()}
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            {description}
          </Text>
        </View>
      </Callout>
    </Marker>
  )
}

type CheckpointMarkerProps = {
  name: string
  capacity: number
  peopleCount: number
  helps: Help[]
}
const CheckpointMarker: React.FC<CheckpointMarkerProps & BaseMarkerProps> = ({
  name,
  capacity,
  coordinate,
  peopleCount,
  helps,
}) => {
  const { ref, toggle } = useCallout()
  const helpsText = helps
    .map((help) => help.name)
    .join(', ')
    .toUpperCase()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-checkpoint.png')}
      coordinate={coordinate}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            {name}
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            {helpsText}
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>
            Zauzeto {peopleCount} od {capacity} mesta
          </Text>
        </View>
      </Callout>
    </Marker>
  )
}

type BlockadeMarkerProps = {
  name: string
}

const BlockadeMarker: React.FC<BlockadeMarkerProps & BaseMarkerProps> = ({
  coordinate,
  name,
}) => {
  const { ref, toggle } = useCallout()

  return (
    <Marker
      ref={ref}
      onPress={toggle}
      image={require('../../assets/pin-blockade.png')}
      coordinate={coordinate}
    >
      <Callout>
        <View style={styles.calloutContainer}>
          <Text style={[typography.bodyEmphasized, styles.calloutTitle]}>
            Blokada
          </Text>
          <Text style={[typography.subhead, styles.calloutText]}>{name}</Text>
        </View>
      </Callout>
    </Marker>
  )
}

type HazardCircleProps = {
  radius: number
}
const HazardCircle: React.FC<HazardCircleProps & BaseMarkerProps> = ({
  coordinate: { longitude, latitude },
  radius,
}) => (
  <Circle
    radius={radius}
    center={{ latitude, longitude }}
    strokeWidth={2}
    strokeColor={colors.red}
    fillColor="rgba(231, 77, 60, 0.212)"
  />
)

const styles = StyleSheet.create({
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

const MapMarkers = {
  Me: MeMarker,
  Transport: TransportMarker,
  Checkpoint: CheckpointMarker,
  Blockade: BlockadeMarker,
  HazardCircle,
} as const

export default MapMarkers
