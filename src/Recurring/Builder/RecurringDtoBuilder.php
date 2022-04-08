<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\Builder;

use BlueMedia\Common\Dto\AbstractDto;
use BlueMedia\Configuration;
use BlueMedia\Hash\HashGenerator;
use BlueMedia\Recurring\Dto\RecurringDeactivationDto;
use BlueMedia\Serializer\Serializer;
use BlueMedia\Transaction\Dto\TransactionDto;

final class RecurringDtoBuilder
{
    public static function build(array $transactionData, Configuration $configuration): AbstractDto
    {
        $serializer = new Serializer();
        $transactionDto = $serializer->serializeDataToDto($transactionData, RecurringDeactivationDto::class);
        $transactionDto->getRecurringDeactivation()->setServiceId($configuration->getServiceId());

        $hash = HashGenerator::generateHash(
            $transactionDto->getRecurringDeactivation()->capitalizedArray(),
            $configuration
        );

        $transactionDto->getRecurringDeactivation()->setHash($hash);

        return $transactionDto;
    }
}
