<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject\RpanResponse;

use JMS\Serializer\Annotation\Type;
use BlueMedia\Serializer\SerializableInterface;

final class RecurringConfirmations implements SerializableInterface
{
    /**
     * @var RecurringConfirmed
     * @Type("BlueMedia\Rpan\ValueObject\RpanResponse\RecurringConfirmed")
     */
    private $recurringConfirmed;

    /**
     * @return RecurringConfirmed
     */
    public function getRecurringConfirmed(): RecurringConfirmed
    {
        return $this->recurringConfirmed;
    }
}
