import { useRoute } from '@react-navigation/core'
import Constants from 'expo-constants'
import * as Linking from 'expo-linking'
import React from 'react'
import { SafeAreaView, StatusBar, StyleSheet, Text } from 'react-native'
import DialIcon from '../../assets/dial.svg'
import { Transport } from '../API'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import useRevereseGeocoding from '../hooks/useReverseGeocoding'
import { colors, typography } from '../theme'

const TransportDetailsScreen: React.FC = () => {
  const { params } = useRoute()
  const {
    description,
    phone_numbers,
    location: {
      coordinates: [longitude, latitude],
    },
  } = params as Transport

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
      <Text style={typography.title3Emphasized}>{description}</Text>
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

export default TransportDetailsScreen
