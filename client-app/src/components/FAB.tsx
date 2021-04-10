import React from 'react'
import { StyleSheet, TouchableOpacityProps } from 'react-native'
import { TouchableOpacity } from 'react-native-gesture-handler'
import { colors } from '../theme'

type Props = {
  color?: keyof typeof colors
}

const FAB: React.FC<Props & TouchableOpacityProps> = (props) => {
  const { children, color = 'midGray', ...rest } = props

  return (
    <TouchableOpacity
      {...rest}
      activeOpacity={0.8}
      style={[rest.style, styles.container, { backgroundColor: colors[color] }]}
    >
      {children}
    </TouchableOpacity>
  )
}

const SIZE = 85
const styles = StyleSheet.create({
  container: {
    width: SIZE,
    height: SIZE,
    borderRadius: SIZE,
    alignItems: 'center',
    justifyContent: 'center',
    shadowColor: colors.black,
    shadowOffset: {
      width: 0,
      height: 4,
    },
    shadowOpacity: 0.3,
    shadowRadius: 4.65,
    elevation: 8,
  },
})

export default FAB
