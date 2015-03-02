<?php

namespace Csv\Tests\Unit\Factory;

use Csv\Factory\SplFileObjectFactory;
use Csv\Value\FilePath;
use Csv\Value\WriteMode;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;

class SplFileObjectFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_object_with_given_path()
    {
        $someDir = 'someDir/';
        vfsStream::setup($someDir);
        $somePath = FilePath::fromNative(vfsStream::url($someDir), 'someFilename', 'someExt');
        $someMode = WriteMode::APPEND();
        $splFileObjectFactory = new SplFileObjectFactory;

        $splFileObject = $splFileObjectFactory->createFromPathAndMode($somePath, $someMode);

        $this->assertInstanceOf(SplFileObject::class, $splFileObject);
        $this->assertEquals($somePath->toNative(), $splFileObject->getPathname());
    }
}
