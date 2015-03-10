<?php

namespace Csv\Factory;

use Csv\Exception\UnsupportedEnclosureStrategyException;
use Csv\Value\EnclosureStrategy;
use Csv\Writer\ExtendedSplWriter;
use Csv\Writer\SplAllEnclosureStrategyWriter;
use Csv\Writer\SplStandardEnclosureStrategyWriter;
use Csv\Writer\SplStandardWithFractionsEnclosureStrategyWriter;
use Csv\Writer\SplNoneEnclosureStrategyWriter;
use Csv\Writer\SplWriter;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

class SplWriterFactory implements WriterFactory
{
    private $fileFactory;

    public function __construct(SplFileObjectFromPathAndModeFactory $file)
    {
        $this->fileFactory = $file;
    }

    public function createNative(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns)
    {
        return new SplWriter(
            $this->fileFactory->createFromPathAndMode($file, $config->getContentConfig()->getWriteMode()),
            $config,
            $columns
        );
    }

    public function createExtended(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns)
    {
        $splFileObject = $this->fileFactory->createFromPathAndMode($file, $config->getContentConfig()->getWriteMode());

        switch ($config->getCsvConfig()->getEnclosure()->getStrategy()->toNative()) {
            case EnclosureStrategy::STANDARD:
                $writer = new SplStandardEnclosureStrategyWriter($splFileObject, $config);
                break;
            case EnclosureStrategy::STANDARD_WITH_FRACTIONS:
                $writer = new SplStandardWithFractionsEnclosureStrategyWriter($splFileObject, $config);
                break;
            case EnclosureStrategy::ALL:
                $writer = new SplAllEnclosureStrategyWriter($splFileObject, $config->getCsvConfig());
                break;
            case EnclosureStrategy::NONE:
                $writer = new SplNoneEnclosureStrategyWriter($splFileObject, $config->getCsvConfig()->getDelimiter());
                break;
            default:
                throw new UnsupportedEnclosureStrategyException;
        }

        return new ExtendedSplWriter($splFileObject, $config, $columns, $writer);
    }
}
