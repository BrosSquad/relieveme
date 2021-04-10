<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateHazardRequest extends FormRequest
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
    #[ArrayShape(['danger' => "string", 'level' => "string", 'location' => "string[]", 'radius' => "string"])]
    public function rules(): array
    {
        return [
            'danger' => 'required|string|max:50',
            'level' => 'required|min:1|max:5',
            'location' => [
                'lat' => 'required',
                'lng' => 'required'
            ],
            'radius' => 'required|numeric'
        ];
    }
}
