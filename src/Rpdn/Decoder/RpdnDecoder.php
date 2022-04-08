<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\Decoder;

use BlueMedia\Common\Enum\ClientEnum;

class RpdnDecoder
{
    public static function decode(string $rpdn): string
    {
        $xmlData = base64_decode($rpdn, true);

        if ($xmlData === false || !preg_match_all(ClientEnum::PATTERN_XML, $xmlData)) {
            throw new \InvalidArgumentException('RPDN data must be an valid XML, base64 encoded.');
        }

        return $xmlData;
    }
}
