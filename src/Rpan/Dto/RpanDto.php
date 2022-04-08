<?php
declare(strict_types=1);

namespace BlueMedia\Rpan\Dto;

use BlueMedia\Common\Dto\AbstractDto;
use BlueMedia\Rpan\ValueObject\Rpan;
use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

final class RpanDto extends AbstractDto implements SerializableInterface
{
    /**
     * @var Rpan
     * @Type("BlueMedia\Rpan\ValueObject\Rpan")
     * @XmlList(inline = true, entry = "transaction")
     */
    private $rpan;

    /**
     * @return Rpan
     */
    public function getRpan(): Rpan
    {
        return $this->rpan;
    }

    public function getRequestData(): SerializableInterface
    {
        return $this->getRpan();
    }
}
