<?php

namespace Csv\Tests\Fixture;

use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;

class EnclosureConfigMother
{
    public static function createDefault()
    {
        return new EnclosureConfig(EnclosureCharacter::QUOTATION_MARK(), EnclosureStrategy::STANDARD());
    }
}
