import { instance } from './index'

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
