<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\Builder;

use BlueMedia\Common\Util\XMLParser;
use BlueMedia\Rpdn\Dto\RpdnDto;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Serializer\Serializer;

final class RpdnDtoBuilder
{
    public static function build(string $rpdnData): SerializableInterface
    {
        $serializer = new Serializer();
        $xmlData = XMLParser::parse($rpdnData);

        $xmlTransaction = $xmlData->asXML();
        $rpdnDto = $serializer->deserializeXml($xmlTransaction, RpdnDto::class);

        $rpdnDto->getRpdn()->setServiceID((string)$xmlData->serviceID);
        $rpdnDto->getRpdn()->setHash((string)$xmlData->hash);

        return $rpdnDto;
    }
}
