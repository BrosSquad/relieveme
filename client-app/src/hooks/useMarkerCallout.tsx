import React from 'react'
import { Marker } from 'react-native-maps'

const useCallout = () => {
  const ref = React.useRef<Marker>(null)

  const [isCalloutVisible, setCalloutVisible] = React.useState(false)
  const toggle = () => setCalloutVisible((prev) => !prev)

  React.useEffect(() => {
    if (ref.current) {
      isCalloutVisible ? ref.current.hideCallout() : ref.current.showCallout()
    }
  }, [isCalloutVisible])

  return {
    ref,
    toggle,
    isCalloutVisible,
  }
}

export default useCallout
