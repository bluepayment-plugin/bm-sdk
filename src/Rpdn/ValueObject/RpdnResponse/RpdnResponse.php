<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\ValueObject\RpdnResponse;

use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Serializer\Serializer;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @XmlRoot("confirmationList")
 *
 * @AccessorOrder("custom",
 *     custom = {
 *      "serviceID",
 *      "recurringConfirmations",
 *      "hash"
 * })
 */
class RpdnResponse implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    private $serviceID;

    /**
     * @var RecurringConfirmations
     * @Type("BlueMedia\Rpdn\ValueObject\RpdnResponse\RecurringConfirmations")
     */
    private $recurringConfirmations;

    /**
     * @var string
     * @Type("string")
     */
    private $hash;

    /**
     * @return string
     */
    public function getServiceID(): string
    {
        return $this->serviceID;
    }

    /**
     * @return RecurringConfirmations
     */
    public function getRecurringConfirmations(): RecurringConfirmations
    {
        return $this->recurringConfirmations;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    public function toXml(): string
    {
        return (new Serializer())->toXml($this);
    }
}
