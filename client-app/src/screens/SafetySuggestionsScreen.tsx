import { useNavigation } from '@react-navigation/native'
import React from 'react'
import { SafeAreaView, StyleSheet, Text, View } from 'react-native'
import CheckmarkCircleIcon from '../../assets/checkmark-circle.svg'
import SuggestionsIcon from '../../assets/suggestions.svg'
import { AppRoutes } from '../AppNavigator'
import Button from '../components/Button'
import { colors, typography } from '../theme'

const SafetySuggestionsScreen: React.FC = () => {
  const navigation = useNavigation()
  const [suggestions, setSuggestions] = React.useState<string[]>([
    'Pazljivo vozite  posto su putevi delimicno poplavljeni',
    'Prijavite prepreke na putu pritiskom ukoliko naidjete na njih',
  ])

  return (
    <SafeAreaView style={styles.container}>
      <SuggestionsIcon style={styles.icon} />
      <Text style={typography.largeTitleEmphasized}>Saveti za bezbednost</Text>
      <View style={styles.suggestionsContainer}>
        {suggestions.map((suggestion, i) => (
          <View style={styles.suggestion} key={i}>
            <CheckmarkCircleIcon style={styles.suggestionIcon} />
            <Text style={[typography.callout, styles.description]}>
              {suggestion}
            </Text>
          </View>
        ))}
        <Button
          style={styles.button}
          onPress={() => navigation.navigate(AppRoutes.HazardMap)}
        >
          Dalje
        </Button>
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
    marginBottom: 32,
    marginRight: 18,
  },
  suggestionsContainer: {
    maxWidth: 350,
    marginTop: 12,
  },
  suggestion: {
    flexDirection: 'row',
    alignItems: 'center',
    marginVertical: 12,
  },
  suggestionIcon: {
    marginRight: 12,
  },
  description: {},
  button: {
    marginTop: 64,
  },
})

export default SafetySuggestionsScreen
