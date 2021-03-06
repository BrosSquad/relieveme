import React from 'react'
import { KeyboardAvoidingView, Platform, StyleSheet, Text } from 'react-native'
import { colors, typography } from '../theme'
import Button from './Button'
import TextArea from './TextArea'

const SHEET_HEIGHT = 600
type Props = {
  onSubmit: (description: string) => void
}
const BlockadeForm: React.FC<Props> = ({ onSubmit }) => {
  const [description, setDescription] = React.useState('')
  const hanleSubmit = () => {
    console.log('hello')
    // onSubmit(description)
    // setDescription('')
  }

  return (
    <KeyboardAvoidingView
      style={styles.sheetContainer}
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
    >
      <Text style={[typography.title3Emphasized, styles.sheetTitle]}>
        Naisli ste na blokadu na putu?
      </Text>
      <Text style={[typography.subhead, styles.sheetSubtitle]}>
        Opisite koja je vrsta blokade u pitanju, budite sto deskriptivniji
      </Text>
      <TextArea
        value={description}
        onChangeText={setDescription}
        style={styles.sheetInput}
      />
      <Button onPress={hanleSubmit}>Posalji</Button>
    </KeyboardAvoidingView>
  )
}

const styles = StyleSheet.create({
  sheetContainer: {
    backgroundColor: colors.white,
    padding: 24,
    height: SHEET_HEIGHT,
  },
  sheetTitle: {
    marginBottom: 6,
  },
  sheetSubtitle: {
    marginBottom: 24,
  },
  sheetInput: {
    marginBottom: 48,
  },
})

export default BlockadeForm
