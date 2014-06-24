<?php

namespace Csv\Value;

use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Value;
use Csv\Value\VisibleNames;
use ValueObjects\ValueObjectInterface;

class CsvConfig extends Value
{
    /**
     * @var Csv\Enum\Delimiter
     */
    private $delimiter;
    
    /**
     * @var Csv\Enum\Enclosure
     */
    private $enclosure;

    /**
     * @var Csv\Value\VisibleNames
     */
    private $visibleNames;

    /**
     * @param Csv\Enum\Delimiter $delimiter required
     * @param Csv\Enum\Enclosure $enclosure required
     * @param Csv\Value\VisibleNames $visibleNames required
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
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $this->delimiter === $object->getDelimiter()
            and $this->enclosure === $object->getEnclosure()
            and $this->visibleNames === $object->getVisibleNames();
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getEnclosure()
    {
        return $this->enclosure;
    }

    public function getVisibleNames()
    {
        return $this->visibleNames;
    }
}