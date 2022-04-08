<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject\RpanResponse;

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
class RpanResponse implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    private $serviceID;

    /**
     * Transaction message ID.
     *
     * @var string
     * @Type("string")
     */
    private $messageID;

    /**
     * @var RecurringConfirmations
     * @Type("BlueMedia\Rpan\ValueObject\RpanResponse\RecurringConfirmations")
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
     * @return string
     */
    public function getMessageID(): string
    {
        return $this->messageID;
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
