<?php

namespace App\Http\Requests\Checkpoints;

use Illuminate\Foundation\Http\FormRequest;

class CreateCheckpointRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'name' => [
                'bail',
                'required',
                'string',
                'unique:checkpoints,name'
            ],
            'location'  => [
                'bail',
                'required',
                'array'
            ],
            'location.latitude' => [
                'bail',
                'required',
                'numeric',
            ],
            'location.longitude' => [
                'bail',
                'required',
                'numeric',
            ],
            'capacity'  => [
                'bail',
                'required',
                'numeric'
            ],
            'phone_numbers'  => [
                'bail',
                'required',
                'string'
            ],
            'description'  => [
                'nullable',
                'string',
            ],
            'people_count'  => [
                'nullable',
                'numeric'
            ],
        ];
    }
}
