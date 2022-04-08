<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\Decoder;

use BlueMedia\Common\Enum\ClientEnum;

class RpanDecoder
{
    public static function decode(string $itn): string
    {
        $xmlData = base64_decode($itn, true);

        if ($xmlData === false || !preg_match_all(ClientEnum::PATTERN_XML, $xmlData)) {
            throw new \InvalidArgumentException('RPAN data must be an valid XML, base64 encoded.');
        }

        return $xmlData;
    }
}
