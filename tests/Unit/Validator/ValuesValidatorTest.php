<?php

namespace Csv\Tests\Unit\Validator;

use Csv\Column\AssertableColumn;
use Csv\Tests\Double\Assertion\StringRepresentableAssertionMock;
use Csv\Tests\Double\Collection\AssertableColumnCollectionMock;
use Csv\Validator\ValuesValidator;
use PHPUnit_Framework_TestCase;

class ValuesValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_true_for_values_with()
    {
        $someNames = ['some name', 'another name'];
        $someColumns = $this->createColumnsWithGivenNames($someNames);
        $testedObject = new ValuesValidator($someColumns);

        $result = $testedObject->validate(array_combine($someNames, $someNames));

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_false_for_different_values()
    {
        $someColumns = $this->createColumnsWithGivenNames(['some name', 'another name']);
        $differentValues = ['different name' => null, 'another different name' => null];
        $testedObject = new ValuesValidator($someColumns);

        $result = $testedObject->validate($differentValues);

        $this->assertFalse($result);
    }

    private function createColumnsWithGivenNames(array $names)
    {
        $assertion = new StringRepresentableAssertionMock;

        $columns = [];
        foreach ($names as $name) {
            $columns[$name] = new AssertableColumn($name, $assertion);
        }

        return new AssertableColumnCollectionMock($columns);
    }
}
