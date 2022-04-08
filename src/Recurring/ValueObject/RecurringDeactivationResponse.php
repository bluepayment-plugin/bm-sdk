<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\ValueObject;

use BlueMedia\Common\ValueObject\AbstractValueObject;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Serializer\Serializer;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "serviceID",
 *      "messageID",
 *      "recurringConfirmations",
 *      "hash"
 * })
 */
class RecurringDeactivationResponse extends AbstractValueObject implements SerializableInterface
{
    /**
     * Transaction service id.
     *
     * @var string
     * @Type("string")
     */
    protected $serviceID;

    /**
     * Transaction message ID.
     *
     * @var string
     * @Type("string")
     */
    protected $messageID;

    /**
     * @var RecurringConfirmations
     * @Type("BlueMedia\Recurring\ValueObject\RecurringConfirmations")
     */
    private $recurringConfirmations;

    /**
     * Transaction hash.
     *
     * @var string
     * @Type("string")
     */
    protected $hash;

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
