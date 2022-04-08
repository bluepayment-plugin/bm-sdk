<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\Builder;

use BlueMedia\Common\Enum\ClientEnum;
use BlueMedia\Configuration;
use BlueMedia\Hash\HashGenerator;
use BlueMedia\Rpdn\ValueObject\Rpdn;
use BlueMedia\Rpdn\ValueObject\RpdnResponse\RpdnResponse;
use BlueMedia\Serializer\Serializer;

final class RpdnBuilder
{
    public static function build(Rpdn $rpdn, bool $transactionConfirmed, Configuration $configuration): RpdnResponse
    {
        $confirmation = $transactionConfirmed ? ClientEnum::STATUS_CONFIRMED : ClientEnum::STATUS_NOT_CONFIRMED;

        $hashData = [
            'serviceID' => $configuration->getServiceId(),
            'clientHash' => $rpdn->getRecurringData()->getClientHash(),
            'confirmation' => $confirmation
        ];

        $rpdnResponseData = [
            'serviceID' => $configuration->getServiceId(),
            'recurringConfirmations' => [
                'recurringConfirmed' => [
                    'clientHash' => $rpdn->getRecurringData()->getClientHash(),
                    'confirmation' => $confirmation
                ],
            ],
            'hash' => HashGenerator::generateHash($hashData, $configuration)
        ];

        $serializer = new Serializer();

        return $serializer->fromArray($rpdnResponseData, RpdnResponse::class);
    }
}
