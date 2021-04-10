import React from 'react'
import {
  StyleSheet,
  Text,
  TouchableOpacity,
  TouchableOpacityProps,
} from 'react-native'
import { colors, typography } from '../theme'

type Props = {
  dark?: boolean
}

const Button: React.FC<Props & TouchableOpacityProps> = (props) => {
  const { children, dark, ...rest } = props
  return (
    <TouchableOpacity
      {...rest}
      style={[
        styles.container,
        props.style,
        dark ? { borderColor: colors.white } : { borderColor: colors.black },
      ]}
    >
      <Text
        style={
          dark ? typography.bodyEmphasizedWhite : typography.bodyEmphasized
        }
      >
        {children}
      </Text>
    </TouchableOpacity>
  )
}

const styles = StyleSheet.create({
  container: {
    height: 48,
    borderRadius: 100,
    borderWidth: 3,
    alignItems: 'center',
    justifyContent: 'center',
  },
})

export default Button
