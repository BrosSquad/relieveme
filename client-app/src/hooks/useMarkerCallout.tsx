import React from 'react'
import { Marker } from 'react-native-maps'

const useCallout = (defaultState?: boolean) => {
  const ref = React.useRef<Marker>(null)

  const [isCalloutVisible, setCalloutVisible] = React.useState<
    boolean | undefined
  >(defaultState)
  const toggle = () => setCalloutVisible((prev) => !prev)

  React.useEffect(() => {
    if (ref.current && isCalloutVisible !== undefined) {
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
