import AsyncStorage from '@react-native-async-storage/async-storage'
import React from 'react'

export type NotificationPayload = {
  id: number
  type: 'hazard'
}
type NotificationContext = {
  notification?: NotificationPayload
  hasNotification: boolean
  setNotification: React.Dispatch<
    React.SetStateAction<NotificationPayload | undefined>
  >
}
const context = React.createContext<NotificationContext>({
  // eslint-disable-next-line @typescript-eslint/no-empty-function
  setNotification: () => {},
  hasNotification: false,
  notification: {
    id: 0,
    type: 'hazard',
  },
})

const STORAGE_KEY = '@notification'
export const NotificationProvider: React.FC = ({ children }) => {
  const [notification, setNotification] = React.useState<NotificationPayload>()
  const contextValue: NotificationContext = React.useMemo(
    () => ({
      setNotification,
      notification,
      hasNotification: notification !== undefined && notification.id !== 0,
    }),
    [notification],
  )

  React.useEffect(() => {
    if (notification) return
    AsyncStorage.getItem(STORAGE_KEY).then((notificationString) => {
      if (notificationString) {
        setNotification(JSON.parse(notificationString))
      }
    })
  }, [notification])

  React.useEffect(() => {
    if (notification) {
      AsyncStorage.setItem(STORAGE_KEY, JSON.stringify(notification))
    }
  }, [notification])

  return <context.Provider value={contextValue}>{children}</context.Provider>
}

export const useNotification = () => React.useContext(context)
