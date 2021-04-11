import * as Location from 'expo-location'
import React from 'react'

export default function useRevereseGeocoding({
  latitude,
  longitude,
}: {
  latitude: number
  longitude: number
}) {
  const [address, setAddress] = React.useState('Loading...')
  React.useEffect(() => {
    Location.reverseGeocodeAsync(
      { latitude, longitude },
      { useGoogleMaps: true },
    ).then((results) => {
      const street = results.find((result) => result.street)?.street
      const city = results.find((result) => result.city)?.city

      setAddress(`${street}, ${city}`)
    })
  }, [latitude, longitude])

  return { address }
}
