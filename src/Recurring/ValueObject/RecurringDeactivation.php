<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\ValueObject;

use BlueMedia\Common\ValueObject\AbstractValueObject;
use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "serviceID",
 *      "messageID",
 *      "clientHash",
 *      "confirmation",
 *      "reason",
 *      "hash"
 * })
 */
class RecurringDeactivation extends AbstractValueObject implements SerializableInterface
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
     * Client Hash.
     *
     * @var string
     * @Type("string")
     */
    protected $clientHash;

    /**
     * confirmation.
     *
     * @var string
     * @Type("string")
     */
    protected $confirmation;

    /**
     * reason.
     *
     * @var string
     * @Type("string")
     */
    protected $reason;

    /**
     * Transaction hash.
     *
     * @var string
     * @Type("string")
     */
    protected $hash;

    /**
     * @param string $serviceID
     * @return RecurringDeactivation
     */
    public function setServiceId(string $serviceID): RecurringDeactivation
    {
        $this->serviceID = $serviceID;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceID(): string
    {
        return $this->serviceID;
    }

    /**
     * @param string $hash
     * @return RecurringDeactivation
     */
    public function setHash(string $hash): RecurringDeactivation
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return trim($this->hash);
    }

    /**
     * @return string
     */
    public function getMessageID(): string
    {
        return $this->messageID;
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
    public function getConfirmation(): string
    {
        return $this->confirmation;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }


}
