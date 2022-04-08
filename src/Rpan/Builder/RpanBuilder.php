<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\Builder;

use BlueMedia\Common\Enum\ClientEnum;
use BlueMedia\Configuration;
use BlueMedia\Hash\HashGenerator;
use BlueMedia\Rpan\ValueObject\Rpan;
use BlueMedia\Rpan\ValueObject\RpanResponse\RpanResponse;
use BlueMedia\Serializer\Serializer;

final class RpanBuilder
{
    public static function build(
        Rpan $rpan,
        bool $transactionConfirmed,
        Configuration $configuration
    ): RpanResponse {
        $confirmation = $transactionConfirmed ? ClientEnum::STATUS_CONFIRMED : ClientEnum::STATUS_NOT_CONFIRMED;

        $hashData = [
            'serviceID' => $configuration->getServiceId(),
            'clientHash' => $rpan->getRecurringData()->getClientHash(),
            'confirmation' => $confirmation
        ];

        $rpanResponseData = [
            'serviceID' => $configuration->getServiceId(),
            'recurringConfirmations' => [
                'recurringConfirmed' => [
                    'clientHash' => $rpan->getRecurringData()->getClientHash(),
                    'confirmation' => $confirmation
                ],
            ],
            'hash' => HashGenerator::generateHash($hashData, $configuration)
        ];

        $serializer = new Serializer();

        return $serializer->fromArray($rpanResponseData, RpanResponse::class);
    }
}
