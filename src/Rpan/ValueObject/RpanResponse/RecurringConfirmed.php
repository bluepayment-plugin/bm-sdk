<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject\RpanResponse;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "clientHash",
 *      "confirmation",
 *      "reason"
 * })
 */
final class RecurringConfirmed implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    private $clientHash;

    /**
     * @var string
     * @Type("string")
     */
    private $confirmation;

    /**
     * reason.
     *
     * @var string
     * @Type("string")
     */
    protected $reason;

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
