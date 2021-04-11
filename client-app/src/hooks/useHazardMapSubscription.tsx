import Pusher, { Channel } from 'pusher-js/react-native'
import React, { Dispatch } from 'react'
import * as API from '../API'
import { useNotification } from './useNotification'

const pusher = new Pusher('eb0e15d7087e9e29933f', { cluster: 'eu' })

type HazardMapContext = {
  hazard?: API.Hazard
  loadMapData: () => Promise<void>
  blockades: API.Blocade[]
  transports: API.Transport[]
  checkpoints: API.Checkpoint[]
  subcribeToMapUpdates: () => void
  isConnected: boolean
  listenForChanges: () => void
  isLoaded: boolean
}
const context = React.createContext<HazardMapContext>({
  blockades: [],
  checkpoints: [],
  // eslint-disable-next-line @typescript-eslint/no-empty-function
  loadMapData: async () => {},
  // eslint-disable-next-line @typescript-eslint/no-empty-function
  subcribeToMapUpdates: () => {},
  // eslint-disable-next-line @typescript-eslint/no-empty-function
  listenForChanges: () => {},
  transports: [],
  isConnected: false,
  isLoaded: false,
})

enum EventActionType {
  CREATED = 'created',
  UPDATED = 'updated',
  DELETED = 'deleted',
  LOAD = 'load',
}

type EventActionPayload<T> = {
  type: EventActionType
  data: T
}

enum Events {
  BLOCKADE = 'blocade-event',
  CHECK = 'check-event',
  CHECKPOINT = 'checkpoint-event',
  HAZARD = 'hazard-event',
  TRANSPORT = 'transport-event',
}

const listReducer = (
  state: any[] = [],
  action: EventActionPayload<any | any[]>,
) => {
  switch (action.type) {
    case EventActionType.CREATED:
      return [...state, action.data]
    case EventActionType.UPDATED: {
      const index = state.findIndex((item: any) => item.id === action.data.id)
      if (index === -1) return state
      state[index] = action.data
      return state
    }
    case EventActionType.DELETED: {
      const index = state.findIndex((item) => item.id === action.data.id)
      if (index === -1) return state
      state.splice(index, 1)
      return state
    }
    case EventActionType.LOAD:
      return action.data
    default:
      return state
  }
}

type Channels = {
  checkpoints: Channel
  transports: Channel
  check: Channel
}
const channel: Channels = {
  checkpoints: pusher.subscribe(`checkpoints`),
  transports: pusher.subscribe(`transports`),
  check: pusher.subscribe(`check`),
}

type PoorlyTypedList<T> = [T[], Dispatch<EventActionPayload<T | T[]>>]
export const HazardMapProvider: React.FC = ({ children }) => {
  const { notification, hasNotification } = useNotification()
  const [hazard, setHazard] = React.useState<API.Hazard>()
  const [
    blockades,
    dispatchBlockades,
  ]: PoorlyTypedList<API.Blocade> = React.useReducer(listReducer, [])
  const [
    checkpoints,
    dispatchCheckpoints,
  ]: PoorlyTypedList<API.Checkpoint> = React.useReducer(listReducer, [])
  const [
    transports,
    dispatchTransports,
  ]: PoorlyTypedList<API.Transport> = React.useReducer(listReducer, [])
  const [isConnected, setConnected] = React.useState(false)
  const [isLoaded, setLoaded] = React.useState(false)

  const loadMapData = React.useCallback(async () => {
    if (isLoaded || !hasNotification || !notification) return

    const { data } = await API.getMapData(notification.id)

    dispatchBlockades({ type: EventActionType.LOAD, data: data.blocades })
    dispatchCheckpoints({ type: EventActionType.LOAD, data: data.checkpoints })
    dispatchTransports({ type: EventActionType.LOAD, data: data.transports })
    setHazard(data.hazard)
    setLoaded(true)
  }, [hasNotification, isLoaded, notification])

  const subcribeToMapUpdates = React.useCallback(() => {
    if (isConnected) return
    if (!hazard) {
      console.log('No hazard.id in subscription')
      return
    }

    setConnected(true)
  }, [hazard, isConnected])

  const listenForChanges = React.useCallback(() => {
    const blockadesChannel = pusher.subscribe(`blocades.${hazard?.id}`)
    blockadesChannel.bind(
      Events.BLOCKADE,
      (payload: EventActionPayload<API.Blocade>) => {
        console.log('Blockade Event')
        dispatchBlockades(payload)
      },
    )
    channel.checkpoints.bind(
      Events.CHECKPOINT,
      (payload: EventActionPayload<API.Checkpoint>) => {
        console.log('Checkpoint Event', payload)
        dispatchCheckpoints(payload)
      },
    )
    channel.transports.bind(
      Events.TRANSPORT,
      (payload: EventActionPayload<API.Transport>) => {
        console.log('Transport Event')
        dispatchTransports(payload)
      },
    )
    channel.check.bind(
      Events.CHECK,
      (payload: EventActionPayload<{ checkpoint_id: number }>) => {
        console.log('Check Event')
        const checkpoint = checkpoints.find(
          (item) => item.id === payload.data.checkpoint_id,
        )
        if (!checkpoint) return
        if (payload.type === EventActionType.CREATED) {
          checkpoint.people_count += 1
        } else if (payload.type === EventActionType.DELETED) {
          checkpoint.people_count -= 1
        }
        dispatchCheckpoints({ type: EventActionType.UPDATED, data: checkpoint })
      },
    )
  }, [checkpoints])

  const contextValue: HazardMapContext = React.useMemo(
    () => ({
      loadMapData,
      hazard,
      blockades,
      transports,
      checkpoints,
      isConnected,
      subcribeToMapUpdates,
      listenForChanges,
      isLoaded,
    }),
    [
      blockades,
      checkpoints,
      hazard,
      loadMapData,
      subcribeToMapUpdates,
      isConnected,
      transports,
      listenForChanges,
      isLoaded,
    ],
  )

  return <context.Provider value={contextValue}>{children}</context.Provider>
}

const useHazardMapSubscription = () => React.useContext(context)
export default useHazardMapSubscription
