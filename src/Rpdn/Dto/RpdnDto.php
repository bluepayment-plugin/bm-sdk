<?php
declare(strict_types=1);

namespace BlueMedia\Rpdn\Dto;

use BlueMedia\Common\Dto\AbstractDto;
use BlueMedia\Itn\ValueObject\Itn;
use BlueMedia\Rpdn\ValueObject\Rpdn;
use BlueMedia\Serializer\SerializableInterface;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\Type;

final class RpdnDto extends AbstractDto implements SerializableInterface
{
    /**
     * @var Rpdn
     * @Type("BlueMedia\Rpdn\ValueObject\Rpdn")
     * @XmlList(inline = true, entry = "transaction")
     */
    private $rpdn;

    /**
     * @return Rpdn
     */
    public function getRpdn(): Rpdn
    {
        return $this->rpdn;
    }

    public function getRequestData(): SerializableInterface
    {
        return $this->getRpdn();
    }
}
