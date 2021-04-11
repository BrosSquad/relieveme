import { useNavigation } from '@react-navigation/core'
import React from 'react'
import { SafeAreaView, StatusBar, StyleSheet, Text, View } from 'react-native'
import CheckmarkIcon from '../../assets/checkmark.svg'
import { AppRoutes } from '../AppNavigator'
import { useNotification } from '../hooks/useNotification'
import { colors, typography } from '../theme'

const WelcomeScreen: React.FC = () => {
  const { hasNotification } = useNotification()
  const navigation = useNavigation()

  if (hasNotification) {
    navigation.navigate(AppRoutes.HazardMap)
  }

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
