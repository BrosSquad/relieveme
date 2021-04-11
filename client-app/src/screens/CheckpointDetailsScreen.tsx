import { useRoute } from '@react-navigation/core'
import Constants from 'expo-constants'
import * as Linking from 'expo-linking'
import React from 'react'
import { SafeAreaView, StatusBar, StyleSheet, Text } from 'react-native'
import DialIcon from '../../assets/dial.svg'
import { Checkpoint } from '../API'
import FAB from '../components/FAB'
import FABContainer from '../components/FABContainer'
import { colors, typography } from '../theme'

const CheckpointDetailsScreen: React.FC = () => {
  const { params } = useRoute()
  const {
    capacity,
    description,
    helps,
    people_count,
    phone_number,
  } = params as Checkpoint

  const handleCall = async () => {
    if (Constants.isDevice) {
      await Linking.openURL(`tel:${phone_number}`)
    } else {
      alert('Phone calls can only be made on real device')
    }
  }

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <Text style={typography.title3Emphasized}>
        Popunjenost: {people_count} / {capacity}
      </Text>
      <Text style={typography.title3Emphasized}>
        Vrste pomoci: {helps.map((help) => help.name).join(', ')}
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
