import { AxiosResponse } from 'axios'
import { instance } from './index'

export interface GetSuggestion {
  id: number
  name: string
  hazard_id: number
  created_at: Date
  updated_at: Date
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
