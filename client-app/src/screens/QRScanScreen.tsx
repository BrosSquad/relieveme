import { BarCodeScanner, BarCodeScannerResult } from 'expo-barcode-scanner'
import React from 'react'
import { StatusBar, StyleSheet, Text } from 'react-native'
import { SafeAreaView } from 'react-native-safe-area-context'
import Svg, { Rect } from 'react-native-svg'
import { colors, typography } from '../theme'

type QRDimensions = { width: number; height: number }
type QROrigin = { x: number; y: number }

const QRScanScreen: React.FC = () => {
  const [hasPermission, setHasPermission] = React.useState<boolean | null>(null)

  const requestPermissions = async () => {
    const { status } = await BarCodeScanner.requestPermissionsAsync()
    setHasPermission(status === 'granted')
  }

  React.useEffect(() => {
    requestPermissions()
  }, [])

  const [scanned, setScanned] = React.useState(false)
  const [dimensions, setDimensions] = React.useState<QRDimensions>()
  const [origin, setOrigin] = React.useState<QROrigin>()

  const handleBarCodeScanned = ({
    type,
    data,
    bounds,
  }: BarCodeScannerResult) => {
    setScanned(true)
    if (bounds) {
      const { size, origin } = bounds

      setDimensions({ height: size.height, width: size.width })
      setOrigin({ x: origin.x, y: origin.y })
    }
    alert(`Bar code with type ${type} and data ${data} has been scanned!`)
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
            {origin && dimensions && (
              <Svg style={StyleSheet.absoluteFillObject}>
                <Rect
                  {...origin}
                  {...dimensions}
                  strokeWidth="2"
                  stroke={colors.red}
                />
              </Svg>
            )}
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
  button: {
    position: 'absolute',
    bottom: 48,
    zIndex: 500,
    width: 200,
  },
  title: {
    position: 'absolute',
    top: 48,
    zIndex: 500,
  },
})

export default QRScanScreen
