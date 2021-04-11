import { useNavigation } from '@react-navigation/core'
import * as Location from 'expo-location'
import React from 'react'
import { SafeAreaView, StatusBar, StyleSheet, Text, View } from 'react-native'
import CheckmarkIcon from '../../assets/checkmark.svg'
import { AppRoutes } from '../AppRoutes'
import Button from '../components/Button'
import { useNotification } from '../hooks/useNotification'
import { useRegisterUser } from '../hooks/useRegisterUser'
import { colors, typography } from '../theme'
import getUserLocation from '../utils/getUserLocation'
import registerForPushNotificationsAsync from '../utils/registerForPushNotificationsAsync'

const WelcomeScreen: React.FC = () => {
  const [expoPushToken, setExpoPushToken] = React.useState<string>()

  React.useEffect(() => {
    registerForPushNotificationsAsync().then((token) => {
      console.log('Set Push Token', token)
      setExpoPushToken(token)
    })
  }, [])

  const { registerUser, getUserToken } = useRegisterUser()
  const [location, setLocation] = React.useState<Location.LocationObject>()

  React.useEffect(() => {
    getUserLocation().then((location) => location && setLocation(location))
  }, [])

  React.useEffect(() => {
    if (expoPushToken && location) {
      registerUser(expoPushToken, location)
    }
    getUserToken().then((token) => console.log('User Token', token))
  }, [expoPushToken, getUserToken, location, registerUser])

  const navigation = useNavigation()
  const { hasNotification } = useNotification()

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <CheckmarkIcon style={styles.icon} />
      <Text style={typography.largeTitleEmphasized}>Dobrodosli</Text>
      <View style={styles.descriptionContainer}>
        <Text style={[typography.title3, styles.description]}>
          Hvala Vam sto ste instalirali nasu aplikaciju, nadamo se da necete
          morati da je koristite.
        </Text>
        <Text style={[typography.title3, styles.description]}>
          Uspesno smo sacuvali vasu lokaciju kako bismo mogli da vas obavestimo
          o nepogodama u Vasoj blizini, sada mozete da zatvorite aplikaciju i
          zaboravite da ste je instalirali.
        </Text>
        {hasNotification && (
          <Button onPress={() => navigation.navigate(AppRoutes.HazardMap)}>
            Idi na Mapu
          </Button>
        )}
      </View>
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
  icon: {
    marginBottom: 12,
  },
  descriptionContainer: {
    maxWidth: 350,
    marginTop: 12,
  },
  description: {
    textAlign: 'center',
    marginBottom: 12,
  },
})

export default WelcomeScreen
