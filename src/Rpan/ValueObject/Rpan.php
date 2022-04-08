<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject;

use BlueMedia\Common\ValueObject\AbstractValueObject;
use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "serviceID",
 *      "transaction",
 *      "recurringData",
 *      "cardData",
 *      "hash"
 * })
 */
final class Rpan extends AbstractValueObject implements SerializableInterface
{
    /**
     * Transaction service id.
     *
     * @var string
     * @Type("string")
     */
    protected $serviceID;

    /**
     * @var Transaction
     * @Type("BlueMedia\Rpan\ValueObject\Transaction")
     */
    protected $transaction;

    /**
     * @var RecurringData
     * @Type("BlueMedia\Rpan\ValueObject\RecurringData")
     */
    protected $recurringData;

    /**
     * @var CardData
     * @Type("BlueMedia\Rpan\ValueObject\CardData")
     */
    protected $cardData;

    /**
     * Itn hash.
     *
     * @var string
     * @Type("string")
     */
    protected $hash;

    /**
     * @param string $serviceID
     * @return Rpan
     */
    public function setServiceID(string $serviceID): Rpan
    {
        $this->serviceID = $serviceID;

        return $this;
    }

    /**
     * @return Transaction
     */
    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    /**
     * @return RecurringData
     */
    public function getRecurringData(): RecurringData
    {
        return $this->recurringData;
    }

    /**
     * @return CardData
     */
    public function getCardData(): CardData
    {
        return $this->cardData;
    }

    /**
     * @param string $hash
     * @return Rpan
     */
    public function setHash(string $hash): Rpan
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
