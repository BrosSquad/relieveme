<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

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
            'location.lat' => [
                'bail',
                'required',
                'numeric',
            ],
            'location.lng' => [
                'bail',
                'required',
                'numeric',
            ],
        ];
    }
}
