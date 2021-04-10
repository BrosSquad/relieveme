<?php

namespace App\Http\Requests\Blocades;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlocadeRequest extends FormRequest
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
            'hazard_id' => [
                'bail',
                'required',
                'numeric',
                'exists:hazards,id'
            ]
        ];
    }
}
