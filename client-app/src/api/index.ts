import axios, { AxiosError, AxiosRequestConfig } from 'axios'

const API_URL = 'http://relieveme.test/api'

const options: AxiosRequestConfig = {
  baseURL: API_URL,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
}

export const instance = axios.create(options)

instance.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    const err = error as AxiosError<{ message: string }>

    // Validation errors
    if (err.response?.status === 422) {
      //@ts-ignore
      console.log(err.response.data.errors)
    }

    const message = err.response?.data.message

    return Promise.reject(message)
  },
)
