<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\Builder;

use BlueMedia\Common\Util\XMLParser;
use BlueMedia\Rpan\ValueObject\Rpan;
use BlueMedia\Serializer\Serializer;

final class RpanVOBuilder
{
    public static function build(string $itnData): Rpan
    {
        $xmlData = XMLParser::parse($itnData);

        $xmlTransaction = $xmlData->asXML();

        return (new Serializer())->deserializeXml($xmlTransaction, Rpan::class);
    }
}
