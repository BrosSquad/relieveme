import React from 'react'
import { StyleSheet, TextInput, TextInputProps, View } from 'react-native'
import { colors } from '../theme'

type BaseProps = Omit<TextInputProps, 'multiline'>

const TextArea: React.FC<BaseProps> = (props) => {
  const { ...rest } = props
  return (
    <View>
      <TextInput {...rest} multiline style={[styles.input, rest.style]} />
    </View>
  )
}

const styles = StyleSheet.create({
  input: {
    height: 175,
    borderRadius: 12,
    paddingHorizontal: 16,
    paddingTop: 12,
    paddingBottom: 12,
    borderWidth: 1,
    borderColor: colors.lightGray,
  },
})

export default TextArea
