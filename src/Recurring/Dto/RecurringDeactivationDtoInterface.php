<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\Dto;

use BlueMedia\Recurring\ValueObject\RecurringDeactivation;

interface RecurringDeactivationDtoInterface
{
    /**
     * @return RecurringDeactivation
     */
    public function getRecurringDeactivation(): RecurringDeactivation;
}
