<?php

namespace App\Http\Requests\Transport;

use App\Models\Transport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTransportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'location' => [
                'bail',
                'required',
                'array',
            ],
            'location.latitude' => [
                'bail',
                'required',
                'numeric'
            ],
            'location.longitude' => [
                'bail',
                'required',
                'numeric'
            ],
            'type' => [
                'bail',
                'required',
                'string',
                Rule::in(
                    [
                        Transport::TYPE_BUS,
                        Transport::TYPE_HELICOPTER,
                        Transport::TYPE_VAN,
                    ]
                ),
            ],
            'phone_numbers' => [
                'bail',
                'required',
                'string',
            ],
            'description' => [
                'bail',
                'nullable',
                'string',
            ],
        ];
    }
}
