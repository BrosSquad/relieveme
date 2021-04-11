import { useNavigation } from '@react-navigation/native'
import React from 'react'
import { SafeAreaView, StyleSheet, Text, View } from 'react-native'
import AlertIcon from '../../assets/alert.svg'
import { AppRoutes } from '../AppRoutes'
import Button from '../components/Button'
import useHazardMapSubscription from '../hooks/useHazardMapSubscription'
import { colors, typography } from '../theme'

const AlertScreen: React.FC = () => {
  const { loadMapData } = useHazardMapSubscription()
  const navigation = useNavigation()

  React.useEffect(() => {
    loadMapData()
  }, [loadMapData])

  return (
    <SafeAreaView style={styles.container}>
      <AlertIcon style={styles.icon} />
      <Text style={typography.largeTitleEmphasizedWhite}>Upozorenje</Text>
      <View style={styles.descriptionContainer}>
        <Text style={[typography.calloutWhite, styles.description]}>
          U velikoj ste opasnosti u vasoj neposrednoj okolini!
        </Text>
        <Button
          dark
          style={styles.button}
          onPress={() => navigation.navigate(AppRoutes.Suggestions)}
        >
          Dalje
        </Button>
      </View>
    </SafeAreaView>
  )
}

const styles = StyleSheet.create({
  container: {
    backgroundColor: colors.red,
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  icon: {
    marginBottom: 12,
  },
  descriptionContainer: {
    maxWidth: 350,
    marginTop: 12,
  },
  description: {
    textAlign: 'center',
  },
  button: {
    marginTop: 64,
  },
})

export default AlertScreen
