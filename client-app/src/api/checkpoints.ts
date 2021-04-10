import { AxiosResponse } from 'axios'
import { instance } from './index'

export interface Location {
  type: string
  coordinates: number[]
}

export type GetCheckpointsResponse = GetCheckpoint[]
export const getCheckpoints = async () => {
  const { data } = await instance.get<GetCheckpointsResponse>('/checkpoints')

  return data
}

export type GetCheckpoint = {
  id: number
  name: string
  location: Location
  capacity: number
  phone_numbers: string
  description: string
  people_count: number
  created_at: Date
  updated_at: Date
}

export const getCheckpoint = async (id: number) => {
  const { data } = await instance.get<GetCheckpointsResponse>(
    `/checkpoints/${id}`,
  )

  return data
}

export type CreateCheckpointCommand = {
  name: string
  location: {
    latitude: number
    longitude: number
  }
  hazard_id: number
  capacity: number
  phone_numbers: string
}
export const createCheckpoint = async (
  createCheckPointCommand: CreateCheckpointCommand,
): Promise<GetCheckpoint> => {
  return await instance.post<CreateCheckpointCommand, GetCheckpoint>(
    `/checkpoints`,
    createCheckPointCommand,
  )
}

export const deleteCheckpoint = async (id: number): Promise<AxiosResponse> => {
  return await instance.delete(`/checkpoints/${id}`)
}
