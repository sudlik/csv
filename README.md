# README

## EXAMPLE

### BASIC USAGE
``` php
use Csv\Builder\DocumentBuilder;
use Csv\Writer\DocumentWriter;

$documentBuilder = new DocumentBuilder('example', 'test.csv');

$documentBuilder
    ->charset('UTF-8')
    ->delimiter(';')
    ->enclosure('"')
    ->visibleNames(true)
    ->withBom(true)

    // Add name
    ->name('Index')
    // csv output:
    //Index

    // Set name at choosen position
    ->name('Description', 1)
    // csv output:
    //Index,Description

    // Overwrite name
    ->name('Number', 0)
    // csv output:
    //Number,Description

    // Add multiple names
    ->names(['Name'])
    // csv output:
    //Number,Description,Name

    // Set multiple names
    ->names([['Second', 1]])
    // csv output:
    //Number,Second,Name

    // Add row
    ->row(['a', 'b', 'c'])
    // csv output:
    //Number,Second,Name
    //,yet another,hello
    //,value,world
    //a,b,c

    // Set row
    ->row([1, 2, 3], 1)
    // csv output:
    //Number,Second,Name
    //,yet another,hello
    //1,2,3
    //a,b,c

(new DocumentWriter)->write($documentBuilder->getDocument());
```
### WRITING IMMEDIATE
``` php
use Csv\Builder\DocumentBuilder;
use Csv\Writer\RowWriter;

$documentBuilder = new DocumentBuilder('example', 'test.csv');

$documentBuilder
    ->charset('UTF-8')
    ->delimiter(';')
    ->enclosure('"')
    ->visibleNames(true)
    ->withBom(true)
    ->name('Index');

(new RowWriter)->write($documentBuilder);

$documentBuilder->row(['a']);
```

## TODO
* add `cell` methods to `DocumentBuilder`
* pointers for cells and rows for flexible chainable programming
* configurable `escape`
* configurable `row end` (currently is always PHP_EOL)
* better name for `visibleNames`
* better name for `withBom`
* add column methods to `DocumentBuilder`
* add data methods to `DocumentBuilder`
* allow edit existing document
* allow add multiple rows
* annotations support
* nameable column index
* fix `phpdox`
* add integration tests
* increase code coverage
* lock file in `RowWrite`
* move updates from `Table` to separate class
* move callbacks from `Table` to separate class
* consider use events or AOP instead of callbacks
