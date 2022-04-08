<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\ValueObject;

use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Type;

/**
 * @AccessorOrder("custom",
 *     custom = {
 *      "orderID",
 *      "remoteID",
 *      "amount",
 *      "currency",
 *      "gatewayID",
 *      "paymentDate",
 *      "paymentStatus",
 *      "paymentStatusDetails",
 *      "startAmount",
 *      "invoiceNumber",
 *      "customerNumber",
 *      "customerEmail",
 *      "customerPhone"
 * })
 */
final class Transaction implements SerializableInterface
{
    /**
     * Transaction order id.
     *
     * @var string
     * @Type("string")
     */
    protected $orderID;

    /**
     * Remote order id.
     *
     * @var string
     * @Type("string")
     */
    protected $remoteID;

    /**
     * Transaction amount.
     *
     * @var string
     * @Type("string")
     */
    protected $amount;

    /**
     * Transaction currency.
     *
     * @var string
     * @Type("string")
     */
    protected $currency;

    /**
     * Transaction gateway id.
     *
     * @var int
     * @Type("int")
     */
    protected $gatewayID;

    /**
     * Payment date. YYYYMMDDhhmmss
     *
     * @var string
     * @Type("string")
     */
    protected $paymentDate;

    /**
     * Payment status.
     *
     * @var string
     * @Type("string")
     */
    protected $paymentStatus;

    /**
     * Payment status details.
     *
     * @var string
     * @Type("string")
     */
    protected $paymentStatusDetails;

    /**
     * Payment start amount.
     *
     * @var string
     * @Type("string")
     */
    protected $startAmount;

    /**
     * Payment invoice Number.
     *
     * @var string
     * @Type("string")
     */
    protected $invoiceNumber;

    /**
     * Payment customer Number.
     *
     * @var string
     * @Type("string")
     */
    protected $customerNumber;

    /**
     * Payment customer Email.
     *
     * @var string
     * @Type("string")
     */
    protected $customerEmail;

    /**
     * Payment customer Phone
     *
     * @var string
     * @Type("string")
     */
    protected $customerPhone;


    /**
     * @return string
     */
    public function getOrderID(): string
    {
        return $this->orderID;
    }

    /**
     * @return string
     */
    public function getRemoteID(): string
    {
        return $this->remoteID;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    /**
     * @return string
     */
    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * @return string
     */
    public function getPaymentStatusDetails(): string
    {
        return $this->paymentStatusDetails;
    }

    /**
     * @return string
     */
    public function getStartAmount(): string
    {
        return $this->startAmount;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }
}
