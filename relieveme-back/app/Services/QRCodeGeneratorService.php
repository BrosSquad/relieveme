<?php

declare(strict_types=1);

namespace App\Services;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Exception;

class QRCodeGeneratorService
{
    public const CHECK_IN = 'in';
    public const CHECK_OUT = 'out';

    /**
     * @param string $codeType
     * @return ResultInterface
     * @throws Exception
     */
    public static function generate(string $codeType): ResultInterface
    {
        $writer = new PngWriter();

        $data = match ($codeType) {
            self::CHECK_IN => '{checkpointId}_' . self::CHECK_IN,
            self::CHECK_OUT => '{checkpointId}_' . self::CHECK_OUT,
        };

        return $writer->write(
            QrCode::create($data)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(300)
                ->setMargin(10)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255))
        );
    }
}
