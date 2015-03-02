<?php

namespace Csv\Tests\Unit\Assertion;

use Csv\Assertion\NaturalAssertion;
use Csv\Value\NaturalRange;
use PHPUnit_Framework_TestCase;

class NaturalAssertionTest extends PHPUnit_Framework_TestCase
{
    public function naturalValues()
    {
        return [[0], ['0'], [-1], [1]];
    }

    /**
     * @test
     * @dataProvider naturalValues
     */
    public function it_should_return_true_for_natural_numbers($givenValue)
    {
        $testedObject = new NaturalAssertion(NaturalRange::fromNative(0, 999999));

        $result = $testedObject->assert($givenValue);

        $this->assertTrue($result);
    }

    public function notNaturalValues()
    {
        return [[0.1], ['0.1'], ['not a number'], [-0.1], ['-0.1']];
    }

    /**
     * @test
     * @dataProvider notNaturalValues
     */
    public function it_should_return_false_for_not_natural_numbers($givenValue)
    {
        $testedObject = new NaturalAssertion(NaturalRange::fromNative(0, 999999));

        $result = $testedObject->assert($givenValue);

        $this->assertFalse($result);
    }
}
