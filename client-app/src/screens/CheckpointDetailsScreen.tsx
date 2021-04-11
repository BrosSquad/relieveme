import { useRoute } from '@react-navigation/core'
import Constants from 'expo-constants'
import * as Linking from 'expo-linking'
import React from 'react'
import { SafeAreaView, StatusBar, StyleSheet, Text } from 'react-native'
import DialIcon from '../../assets/dial.svg'
import { Checkpoint } from '../API'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import useRevereseGeocoding from '../hooks/useReverseGeocoding'
import { colors, typography } from '../theme'

const CheckpointDetailsScreen: React.FC = () => {
  const { params } = useRoute()
  const {
    id,
    capacity,
    description,
    helps,
    people_count,
    phone_numbers,
    location: {
      coordinates: [longitude, latitude],
    },
  } = params as Checkpoint
  const { address } = useRevereseGeocoding({ latitude, longitude })

  const handleCall = async () => {
    if (Constants.isDevice) {
      await Linking.openURL(`tel:${phone_numbers}`)
    } else {
      alert('Phone calls can only be made on real device')
    }
  }

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <Text style={typography.title3Emphasized}>{address}</Text>
      <Text style={typography.title3Emphasized}>
        Popunjenost: {people_count} / {capacity}
      </Text>
      <Text style={typography.title3Emphasized}>
        Vrste pomoci: {helps ? helps.map((help) => help.name).join(', ') : ''}
      </Text>
      <Text style={typography.title3Emphasized}>
        Identifikacioni broj: {id}
      </Text>
      <Text style={typography.body}>{description}</Text>
      <FABContainer position="bottom-right">
        <FAB color="green" onPress={handleCall}>
          <DialIcon />
        </FAB>
      </FABContainer>
    </SafeAreaView>
  )
}

const styles = StyleSheet.create({
  container: {
    backgroundColor: colors.white,
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
})

export default CheckpointDetailsScreen
