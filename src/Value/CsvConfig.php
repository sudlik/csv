<?php

namespace Csv\Value;

use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use ValueObjects\ValueObjectInterface;

/**
 * Class CsvConfig
 * @package Csv
 */
final class CsvConfig extends Value
{
    /**
     * @var Delimiter
     */
    private $delimiter;

    /**
     * @var Enclosure
     */
    private $enclosure;

    /**
     * @var VisibleNames
     */
    private $visibleNames;

    /**
     * @param Delimiter $delimiter required
     * @param Enclosure $enclosure required
     * @param VisibleNames $visibleNames required
     */
    public function __construct(Delimiter $delimiter, Enclosure $enclosure, VisibleNames $visibleNames)
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->visibleNames = $visibleNames;
    }

    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function fromNative()
    {
        return new self(func_get_arg(0), func_get_arg(1), func_get_arg(2));
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  self $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $this->delimiter === $object->getDelimiter()
            and $this->enclosure === $object->getEnclosure()
            and $this->visibleNames === $object->getVisibleNames();
    }

    /**
     * @return Delimiter
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return Enclosure
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * @return VisibleNames
     */
    public function getVisibleNames()
    {
        return $this->visibleNames;
    }
}
