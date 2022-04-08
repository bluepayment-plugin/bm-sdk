<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\ValueObject;

use JMS\Serializer\Annotation\Type;
use BlueMedia\Serializer\SerializableInterface;

final class RecurringConfirmations implements SerializableInterface
{
    /**
     * @var RecurringConfirmed
     * @Type("BlueMedia\Recurring\ValueObject\RecurringConfirmed")
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
