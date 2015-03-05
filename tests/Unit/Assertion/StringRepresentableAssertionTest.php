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
        return [[''], [0], [true], [null], [new Exception]];
    }

    /**
     * @test
     * @dataProvider stringRepresentableValues
     * @param $givenValue
     */
    public function it_should_return_true_for_scalar_null_and_object_with_tostring($givenValue)
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 999999));

        $result = $testedObject->assert($givenValue);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_return_true_for_good_sized_string()
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 30));
        $goodSizedString = 'string with at most 30 chars';

        $result = $testedObject->assert($goodSizedString);

        $this->assertTrue($result);
    }

    public function valuesNotRepresentableAsString()
    {
        return [[[]], [new StdClass]];
    }

    /**
     * @test
     * @dataProvider valuesNotRepresentableAsString
     * @param $givenValue
     */
    public function it_should_return_false_for_array_and_object_without_tostring($givenValue)
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 1));

        $result = $testedObject->assert($givenValue);

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function it_should_return_false_for_bad_sized_string()
    {
        $testedObject = new StringRepresentableAssertion(NaturalRange::fromNative(0, 20));
        $goodSizedString = 'string with at more than 20 chars';

        $result = $testedObject->assert($goodSizedString);

        $this->assertFalse($result);
    }
}
