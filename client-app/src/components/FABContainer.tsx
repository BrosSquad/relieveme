import React from 'react'
import { StyleSheet, View } from 'react-native'

type Props = {
  position: 'top-left' | 'top-right' | 'bottom-left' | 'bottom-right'
  gap?: number
}

const FABContainer: React.FC<Props> = ({
  position = 'bottom-right',
  children,
  gap = 6,
}) => {
  const sides = position.split('-') as [Side, Side]

  return (
    <View style={containerStyle(sides)}>
      {React.Children.map(children, (child) => (
        <View style={{ margin: gap }}>{child}</View>
      ))}
    </View>
  )
}

const INSET = 18
type Side = 'top' | 'right' | 'bottom' | 'left'

const containerStyle = (sides: [Side, Side]) => {
  const { container } = StyleSheet.create({
    // eslint-disable-next-line react-native/no-unused-styles
    container: {
      zIndex: 500,
      position: 'absolute',
      [sides[0]]: INSET,
      [sides[1]]: INSET,
    },
  })
  return container
}

export default FABContainer
