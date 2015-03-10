<?php

namespace Csv\Tests;

use Csv\Value\Column;
use Csv\Writer\Writer;
use Csv\Tests\Fixture\FilePathMother;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;
use PHPUnit_Framework_TestCase;
use XHProfRuns_Default;

abstract class PerformanceTestCase extends PHPUnit_Framework_TestCase
{
    private static $XHPROF_OPTS = [
        'ignored_functions' => [
            'spl_autoload_call',
            'Composer\Autoload\ClassLoader::loadClass',
            'Composer\Autoload\includeFile',
            '???_op',
            'Composer\Autoload\ClassLoader::loadClass@1',
            'Composer\Autoload\includeFile@1',
            '???_op@1',
            'Composer\Autoload\ClassLoader::loadClass@2',
            'Composer\Autoload\ClassLoader::findFile',
            'Composer\Autoload\ClassLoader::findFileWithExtension',
            'Composer\Autoload\includeFile@2',
            'file_exists',
            'load::MabeEnum/Enum.php',
        ],
    ];

    /** @var FilePath */
    private $filePath;

    /** @var WriterConfig */
    private $writerConfig;

    private $values = [];
    private $columns = [];

    public function setUp()
    {
        xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY, self::$XHPROF_OPTS);

        for ($i = 0; $i < 10; $i++) {
            $name = md5($i);
            $this->values[$name] = $name;

            $this->columns[] = new Column($name);
        }

        $this->filePath = FilePathMother::createDefault();
        $this->writerConfig = WriterConfigMother::createDefault();
    }

    public function test()
    {
        $writer = $this->getWriter();

        for ($i = 0; $i < 10000; $i++) {
            $writer->write($this->values);
        }
    }

    public function tearDown()
    {
        $run = (new XHProfRuns_Default)->save_run(xhprof_disable(), $this->getSource());

        echo "\n http://localhost/xhprof/xhprof_html/index.php?run={$run}&source={$this->getSource()}\n";

        unlink($this->filePath->toNative());
    }

    /**
     * @return string
     */
    abstract protected function getSource();

    /**
     * @return Writer
     */
    abstract protected function getWriter();

    /**
     * @return string
     */
    abstract public function getColumnCollectionClassName();

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getColumns()
    {
        $className = $this->getColumnCollectionClassName();

        return new $className($this->columns, true);
    }

    public function getWriterConfig()
    {
        return $this->writerConfig;
    }
}
