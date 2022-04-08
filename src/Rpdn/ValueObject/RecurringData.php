<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\ValueObject;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "recurringAction",
 *      "clientHash",
 *      "deactivationSource",
 *      "deactivationDate"
 * })
 */
final class RecurringData implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    protected $recurringAction;

    /**
     * @var string
     * @Type("string")
     */
    protected $clientHash;

    /**
     * @var string
     * @Type("string")
     */
    protected $deactivationSource;

    /**
     * @var string
     * @Type("string")
     */
    protected $deactivationDate;

    /**
     * @return string
     */
    public function getRecurringAction(): string
    {
        return $this->recurringAction;
    }

    /**
     * @return string
     */
    public function getClientHash(): string
    {
        return $this->clientHash;
    }

    /**
     * @return string
     */
    public function getDeactivationSource(): string
    {
        return $this->deactivationSource;
    }

    /**
     * @return string
     */
    public function getDeactivationDate(): string
    {
        return $this->deactivationDate;
    }
}
