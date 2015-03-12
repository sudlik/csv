<?php

namespace Csv\Tests\Fixture;

use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\Escape;

class CsvConfigMother
{
    public static function createDefault()
    {
        return new CsvConfig(Delimiter::COMMA(), EnclosureConfigMother::createDefault(), Escape::QUOTATION_MARK());
    }
}
