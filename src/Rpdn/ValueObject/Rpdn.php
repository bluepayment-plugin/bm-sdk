<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\ValueObject;

use BlueMedia\Common\ValueObject\AbstractValueObject;
use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "serviceID",
 *      "recurringData",
 *      "hash"
 * })
 */
final class Rpdn extends AbstractValueObject implements SerializableInterface
{
    /**
     * Transaction service id.
     *
     * @var string
     * @Type("string")
     */
    protected $serviceID;

    /**
     * @var RecurringData
     * @Type("BlueMedia\Rpdn\ValueObject\RecurringData")
     */
    protected $recurringData;

    /**
     * Rpdn hash.
     *
     * @var string
     * @Type("string")
     */
    protected $hash;

    /**
     * @param string $serviceID
     * @return Rpdn
     */
    public function setServiceID(string $serviceID): Rpdn
    {
        $this->serviceID = $serviceID;

        return $this;
    }

    /**
     * @return RecurringData
     */
    public function getRecurringData(): RecurringData
    {
        return $this->recurringData;
    }

    /**
     * @param string $hash
     * @return Rpdn
     */
    public function setHash(string $hash): Rpdn
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
}
