<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\Builder;

use BlueMedia\Common\Util\XMLParser;
use BlueMedia\Rpdn\ValueObject\Rpdn;
use BlueMedia\Serializer\Serializer;

final class RpdnVOBuilder
{
    public static function build(string $rpdnData): Rpdn
    {
        $xmlData = XMLParser::parse($rpdnData);

        $xmlTransaction = $xmlData->asXML();

        return (new Serializer())->deserializeXml($xmlTransaction, Rpdn::class);
    }
}
