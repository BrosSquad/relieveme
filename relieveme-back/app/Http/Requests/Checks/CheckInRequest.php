<?php

namespace App\Http\Requests\Checks;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
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
    public function rules()
    {
        return [
            'status' => 'bail|required|integer|size:1',
            'user_identifier' => 'bail|required|string',
            'checkpoint_id' => 'bail|required|integer'
        ];
    }
}
