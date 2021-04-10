<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\QRCodeGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Validation\Rule;

class QRCodeGeneratorController extends Controller
{
    public function generate(Request $request): JsonResponse|Response
    {
        $qrCodeType = $request->validate(
            [
                'code_type' => 'bail|required|string|',
                Rule::in([QRCodeGeneratorService::CHECK_IN, QRCodeGeneratorService::CHECK_OUT]),
            ]
        )['code_type'];

        try {
            $qrCode = QRCodeGeneratorService::generate($qrCodeType);

            return response(
                $qrCode->getString(),
                Response::HTTP_OK
            )->withHeaders(
                [
                    'Content-Type' => $qrCode->getMimeType()
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => 'QR code generation failed, we apologize for the inconvinience.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
