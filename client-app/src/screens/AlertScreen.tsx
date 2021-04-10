import React from 'react'
import { SafeAreaView, StyleSheet, Text, View } from 'react-native'
import AlertIcon from '../../assets/alert.svg'
import Button from '../components/Button'
import { colors, typography } from '../theme'

const AlertScreen: React.FC = () => {
  return (
    <SafeAreaView style={styles.container}>
      <AlertIcon style={styles.icon} />
      <Text style={typography.largeTitleEmphasizedWhite}>Upozorenje</Text>
      <View style={styles.descriptionContainer}>
        <Text style={[typography.calloutWhite, styles.description]}>
          U velikoj ste opasnosti od poplave u vasoj neposrednoj okolini!
        </Text>
        <Button dark style={styles.button}>
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
