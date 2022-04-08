<?php
declare(strict_types=1);

namespace BlueMedia\Itn\ValueObject;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "fName",
 *      "lName",
 *      "streetName",
 *      "streetHouseNo",
 *      "streetStaircaseNo",
 *      "streetPremiseNo",
 *      "postalCode",
 *      "city",
 *      "nrb",
 *      "senderData"
 * })
 */
final class CustomerData implements SerializableInterface
{
    /**
     * @var string
     * @Type("string")
     */
    protected $fName;

    /**
     * @var string
     * @Type("string")
     */
    protected $lName;

    /**
     * @var string
     * @Type("string")
     */
    protected $streetName;

    /**
     * @var string
     * @Type("string")
     */
    protected $streetHouseNo;

    /**
     * @var string
     * @Type("string")
     */
    protected $streetStaircaseNo;

    /**
     * @var string
     * @Type("string")
     */
    protected $streetPremiseNo;

    /**
     * @var string
     * @Type("string")
     */
    protected $postalCode;

    /**
     * @var string
     * @Type("string")
     */
    protected $city;

    /**
     * @var string
     * @Type("string")
     */
    protected $nrb;

    /**
     * @var string
     * @Type("string")
     */
    protected $senderData;

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->fName;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->lName;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @return string
     */
    public function getStreetHouseNo(): string
    {
        return $this->streetHouseNo;
    }

    /**
     * @return string
     */
    public function getStreetStaircaseNo(): string
    {
        return $this->streetStaircaseNo;
    }

    /**
     * @return string
     */
    public function getStreetPremiseNo(): string
    {
        return $this->streetPremiseNo;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getNrb(): string
    {
        return $this->nrb;
    }

    /**
     * @return string
     */
    public function getSenderData(): string
    {
        return $this->senderData;
    }
}
