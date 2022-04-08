<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\Dto;

use BlueMedia\Common\Dto\AbstractDto;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Recurring\ValueObject\RecurringDeactivation;
use JMS\Serializer\Annotation\Type;

final class RecurringDeactivationDto extends AbstractDto implements RecurringDeactivationDtoInterface
{
    /**
     * @var RecurringDeactivation
     * @Type("BlueMedia\Recurring\ValueObject\RecurringDeactivation")
     */
    private $recurringDeactivation;

    /**
     * @return RecurringDeactivation
     */
    public function getRecurringDeactivation(): RecurringDeactivation
    {
        return $this->recurringDeactivation;
    }

    public function getRequestData(): SerializableInterface
    {
        return $this->getRecurringDeactivation();
    }
}
