<?php

namespace App\Http\Requests\Suggestions;

use Illuminate\Foundation\Http\FormRequest;

class CreateSuggestionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'bail|required|string',
            'hazard_id' => 'bail|required|numeric|exists:hazards,id',
        ];
    }
}
