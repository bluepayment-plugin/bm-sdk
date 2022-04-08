<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "index",
 *      "validityYear",
 *      "validityMonth",
 *      "issuer",
 *      "bin",
 *      "mask"
 * })
 */
final class CardData implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    protected $index;

    /**
     * @var string
     * @Type("string")
     */
    protected $validityYear;

    /**
     * @var string
     * @Type("string")
     */
    protected $validityMonth;

    /**
     * @var string
     * @Type("string")
     */
    protected $issuer;

    /**
     * @var string
     * @Type("string")
     */
    protected $bin;

    /**
     * @var string
     * @Type("string")
     */
    protected $mask;

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getValidityYear(): string
    {
        return $this->validityYear;
    }

    /**
     * @return string
     */
    public function getValidityMonth(): string
    {
        return $this->validityMonth;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @return string
     */
    public function getBin(): string
    {
        return $this->bin;
    }

    /**
     * @return string
     */
    public function getMask(): string
    {
        return $this->mask;
    }
}
