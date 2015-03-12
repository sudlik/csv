<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;
use PHPUnit_Framework_TestCase;

class EnclosureConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_wth_given_params()
    {
        $someCharacter = EnclosureCharacter::APOSTROPHE();
        $someStrategy = EnclosureStrategy::ALL();

        $result = new EnclosureConfig($someCharacter, $someStrategy);

        self::assertTrue($someCharacter->is($result->getCharacter()));
        self::assertTrue($someStrategy->is($result->getStrategy()));
    }

    /**
     * @test
     */
    public function it_should_create_object_from_native_params()
    {
        $someCharacter = EnclosureCharacter::APOSTROPHE;
        $someStrategy = EnclosureStrategy::ALL;

        $result = EnclosureConfig::fromNative($someCharacter, $someStrategy);

        self::assertEquals($someCharacter, $result->getCharacter()->getValue());
        self::assertEquals($someStrategy, $result->getStrategy()->getValue());
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someCharacter = EnclosureCharacter::APOSTROPHE();
        $someStrategy = EnclosureStrategy::ALL();
        $testedObject = new EnclosureConfig($someCharacter, $someStrategy);
        $sameEnclosureConfig = new EnclosureConfig($someCharacter, $someStrategy);

        $result = $testedObject->sameValueAs($sameEnclosureConfig);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someCharacter = EnclosureCharacter::APOSTROPHE();
        $someStrategy = EnclosureStrategy::ALL();
        $differentCharacter = EnclosureCharacter::GRAVE_ACCENT();
        $differentStrategy = EnclosureStrategy::NONE();
        $testedObject = new EnclosureConfig($someCharacter, $someStrategy);
        $differentEnclosureConfig = new EnclosureConfig($differentCharacter, $differentStrategy);

        $result = $testedObject->sameValueAs($differentEnclosureConfig);

        self::assertFalse($result);
    }
}
