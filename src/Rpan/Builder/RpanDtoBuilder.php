<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\Builder;

use BlueMedia\Common\Util\XMLParser;
use BlueMedia\Rpan\Dto\RpanDto;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Serializer\Serializer;

final class RpanDtoBuilder
{
    public static function build(string $itnData): SerializableInterface
    {
        $serializer = new Serializer();
        $xmlData = XMLParser::parse($itnData);

        $xmlTransaction = $xmlData->asXML();

        $itnDto = $serializer->deserializeXml($xmlTransaction, RpanDto::class);

        $itnDto->getRpan()->setServiceID((string)$xmlData->serviceID);
        $itnDto->getRpan()->setHash((string)$xmlData->hash);

        return $itnDto;
    }
}
