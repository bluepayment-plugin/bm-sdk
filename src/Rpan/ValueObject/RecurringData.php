<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "recurringAction",
 *      "clientHash",
 *      "expirationDate"
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
    protected $expirationDate;

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
    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }
}
