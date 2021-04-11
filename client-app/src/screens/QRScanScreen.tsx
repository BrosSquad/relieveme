import { useNavigation } from '@react-navigation/core'
import { BarCodeScanner, BarCodeScannerResult } from 'expo-barcode-scanner'
import React from 'react'
import { StatusBar, StyleSheet, Text } from 'react-native'
import { SafeAreaView } from 'react-native-safe-area-context'
import CheckmarkIcon from '../../assets/checkmark-circle-large.svg'
import * as API from '../API'
import { useRegisterUser } from '../hooks/useRegisterUser'
import { typography } from '../theme'

const QRScanScreen: React.FC = () => {
  const [hasPermission, setHasPermission] = React.useState<boolean | null>(null)
  const { getUserToken } = useRegisterUser()

  const requestPermissions = async () => {
    const { status } = await BarCodeScanner.requestPermissionsAsync()
    setHasPermission(status === 'granted')
  }

  React.useEffect(() => {
    requestPermissions()
  }, [])

  const [scanned, setScanned] = React.useState(false)
  const navigation = useNavigation()

  const handleBarCodeScanned = async ({ data }: BarCodeScannerResult) => {
    setScanned(true)
    const token = await getUserToken()
    if (!token) {
      console.log('No userID found.')
      return
    }
    await API.checkIn({
      checkpoint_id: parseInt(data.split('_')[0]),
      status: 1,
      user_identifier: token,
    })
  }

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <Text style={[typography.largeTitleEmphasized, styles.title]}>
        Skenirajte QR Kod
      </Text>
      {hasPermission === null && (
        <Text style={typography.title3}>Dozvolite koriscenje kamere</Text>
      )}
      {hasPermission === false && (
        <Text style={typography.title3}>Pristup kameri nije dozvoljen</Text>
      )}
      {!!hasPermission && (
        <>
          <BarCodeScanner
            onBarCodeScanned={scanned ? undefined : handleBarCodeScanned}
            style={styles.scanner}
            barCodeTypes={['qr']}
          >
            {scanned && <CheckmarkIcon onPress={() => navigation.goBack()} />}
          </BarCodeScanner>
        </>
      )}
    </SafeAreaView>
  )
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  scanner: {
    ...StyleSheet.absoluteFillObject,
    alignItems: 'center',
    justifyContent: 'center',
  },
  title: {
    position: 'absolute',
    top: 48,
    zIndex: 500,
  },
})

export default QRScanScreen
