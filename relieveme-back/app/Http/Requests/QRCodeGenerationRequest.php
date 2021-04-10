<?php

namespace App\Http\Requests;

use App\Services\QRCodeGeneratorService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QRCodeGenerationRequest extends FormRequest
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
            'code_type' => [
                'bail',
                'required',
                'string',
                Rule::in(
                    [
                        QRCodeGeneratorService::CHECK_IN,
                        QRCodeGeneratorService::CHECK_OUT,
                    ]
                ),
            ],
            'checkpoint_id' => [
                'bail',
                'required',
                'numeric',
                // TODO: exists:checkpoints
            ],
        ];
    }
}
