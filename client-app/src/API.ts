import axios, { AxiosResponse } from 'axios'

export const instance = axios.create({
  baseURL: 'http://192.168.0.14/api',
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
})

export type Checkpoint = {
  id: number
  name: string
  location: Location
  capacity: number
  phone_number: string
  description: string
  people_count: number
  created_at: string
  updated_at: string
  helps: Help[]
}

export const getCheckpoint = async (id: number) => {
  return instance.get<Checkpoint>(`/checkpoints/${id}`)
}

export type CreateCheckpointPayload = {
  name: string
  location: {
    latitude: number
    longitude: number
  }
  hazard_id: number
  capacity: number
  phone_number: stri
}

export const createCheckpoint = (payload: CreateCheckpointPayload) => {
  return instance.post<CreateCheckpointPayload, Checkpoint>(
    `/checkpoints`,
    payload,
  )
}

export const deleteCheckpoint = async (id: number) => {
  return instance.delete(`/checkpoints/${id}`)
}

export const generateQRCode = async (
  codeType: string,
  checkpointId: number,
) => {
  return instance.get(
    `/generateQR?code_type=${codeType}&checkpoint_id=${checkpointId}`,
    {
      headers: {
        'Content-Type': 'image/png',
      },
    },
  )
}

export type CheckIn = {}

export type CheckInCommand = {
  status: number
  user_identifier: string
  checkpoint_id: number
}
export const checkIn = async (checkInCommand: CheckInCommand) => {
  return await instance.post<CheckInCommand, CheckIn>(
    '/checkIn',
    checkInCommand,
  )
}

export const checkOut = async () => {}

export const register = async (
  expo: string,
  location: {
    lat: number
    lng: number
  },
): Promise<AxiosResponse<{ token: string }>> => {
  const response = await instance.post(`/register`, {
    expo,
    location,
  })
  console.log('Hello', response)
  return response
}

export interface GetSuggestion {
  id: number
  name: string
  hazard_id: number
  created_at: string
  updated_at: string
}

export type GetSuggestionsResponse = GetSuggestion[]
export const getSuggestions = async (): Promise<GetSuggestionsResponse> => {
  const { data } = await instance.get<GetSuggestionsResponse>('/suggestions')

  return data
}

export const getSuggestion = async (id: number): Promise<GetSuggestion> => {
  const { data } = await instance.get<GetSuggestion>(`/suggestions/${id}`)

  return data
}

export type CreateSuggestionCommand = {
  name: string
  hazard_id: number
}
export const createSuggestion = async (
  createSuggestionCommand: CreateSuggestionCommand,
): Promise<GetSuggestion> => {
  return await instance.post<CreateSuggestionCommand, GetSuggestion>(
    `/suggestions`,
    createSuggestionCommand,
  )
}

export const deleteSuggestion = async (id: number): Promise<AxiosResponse> => {
  return await instance.delete(`/suggestions/${id}`)
}

/**
 * MAP
 */

export interface GetMapDataResponse {
  hazard: Hazard
  transports: Transport[]
  checkpoints: Checkpoint[]
  blocades: Blocade[]
}

export interface Blocade {
  id: number
  name: string
  location: Location
  hazard_id: number
  created_at: string
  updated_at: string
}

export interface Location {
  type: LocationType
  coordinates: number[] // [longitude, latitude]
}

export enum LocationType {
  Point = 'Point',
}

export interface Help {
  id: number
  name: string
  created_at: string
  updated_at: string
}

export interface Hazard {
  id: number
  danger: string
  level: number
  location: Location
  radius: number
  created_at: string
  updated_at: string
}

export interface Transport {
  id: number
  location: Location
  type: TransportType
  phone_number: string
  description: string
  created_at: string
  updated_at: string
}

export enum TransportType {
  Autobus = 'autobus',
  Helikopter = 'helikopter',
  Kombi = 'kombi',
}

export const getMapData = async (
  hazardID: number,
): Promise<AxiosResponse<GetMapDataResponse>> => {
  return instance.get(`/map-data/${hazardID}`)
}
