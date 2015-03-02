<?php

namespace Csv\Tests\Unit\Factory;

use Csv\Collection\ColumnCollection;
use Csv\Factory\ValuesValidatorFactory;
use Csv\Validator\ValuesValidator;
use PHPUnit_Framework_TestCase;

class ValuesValidatorFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_object_with_given_path()
    {
        $splFileObjectFactory = new ValuesValidatorFactory;

        $valuesValidator = $splFileObjectFactory->createFromColumns(new ColumnCollection([], true));

        $this->assertInstanceOf(ValuesValidator::class, $valuesValidator);
    }
}
