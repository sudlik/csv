<?php

namespace Csv\Tests\Unit\Assertion;

use Csv\Assertion\StringRepresentableAssertion;
use Csv\Value\NaturalRange;
use Exception;
use PHPUnit_Framework_TestCase;
use stdClass;

class StringRepresentableAssertionTest extends PHPUnit_Framework_TestCase
{
    public function stringRepresentableValues()
    {
        return [['', 0, true, null, new Exception]];
    }

    /**
     * @test
     * @dataProvider stringRepresentableValues
     */
    public function it_should_return_true($givenValue)
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 1));

        $result = $testedObject->assert($givenValue);

        $this->assertTrue($result);
    }

    public function valuesNotRepresentableAsString()
    {
        return [[array(), new StdClass]];
    }

    /**
     * @test
     * @dataProvider valuesNotRepresentableAsString
     */
    public function it_should_return_false($givenValue)
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 1));

        $result = $testedObject->assert($givenValue);

        $this->assertFalse($result);
    }
}
