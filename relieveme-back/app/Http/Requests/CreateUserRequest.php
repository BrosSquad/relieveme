<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateUserRequest extends FormRequest
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
            'expo' => [
                'bail',
                'required',
                'string',
                'unique:expos,token'
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
        ];
    }
}
