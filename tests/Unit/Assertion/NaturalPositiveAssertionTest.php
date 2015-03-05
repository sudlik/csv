<?php

namespace Csv\Tests\Unit\Assertion;

use Csv\Assertion\NaturalPositiveAssertion;
use Csv\Value\NaturalRange;
use PHPUnit_Framework_TestCase;

class NaturalPositiveAssertionTest extends PHPUnit_Framework_TestCase
{
    public function naturalPositiveValues()
    {
        return [[1], ['1']];
    }

    /**
     * @test
     * @dataProvider naturalPositiveValues
     * @param $givenValue
     */
    public function it_should_return_true_for_natural_positive_numbers($givenValue)
    {
        $testedObject = new NaturalPositiveAssertion(NaturalRange::fromNative(0, 999999));

        $result = $testedObject->assert($givenValue);

        $this->assertTrue($result);
    }

    public function notPositiveNaturalValues()
    {
        return [[-1], ['-1'], ['0'], [0]];
    }

    /**
     * @test
     * @dataProvider notPositiveNaturalValues
     * @param $givenValue
     */
    public function it_should_return_false_for_not_positive_natural_numbers($givenValue)
    {
        $testedObject = new NaturalPositiveAssertion(NaturalRange::fromNative(0, 999999));

        $result = $testedObject->assert($givenValue);

        $this->assertFalse($result);
    }
}
