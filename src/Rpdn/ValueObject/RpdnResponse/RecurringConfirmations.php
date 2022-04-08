<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\ValueObject\RpdnResponse;

use JMS\Serializer\Annotation\Type;
use BlueMedia\Serializer\SerializableInterface;

final class RecurringConfirmations implements SerializableInterface
{
    /**
     * @var RecurringConfirmed
     * @Type("BlueMedia\Rpdn\ValueObject\RpdnResponse\RecurringConfirmed")
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
