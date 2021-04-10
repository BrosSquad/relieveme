<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QRCodeGenerationRequest;
use App\Services\QRCodeGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class QRCodeGeneratorController extends Controller
{
    public function generate(QRCodeGenerationRequest $request): JsonResponse|Response
    {
    try {
            $codeType = $request->validated()['code_type'];
            $checkpointId = $request->validated()['checkpoint_id'];

            $qrCode = QRCodeGeneratorService::generate($codeType, intval($checkpointId));

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
                    'message' => 'QR code generation failed, we apologize for the inconvinience.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
