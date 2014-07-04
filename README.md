# README

## EXAMPLE

``` php
(new Csv\Builder\DocumentBuilder('example', 'test.csv'))
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

    ->getDocument()
    ->write();
```

## TODO
    * add cell methods to DocumentBuilder
    * pointers
    * configurable escape
    * configurable row end
    * better name for `visibleNames`
    * better name for `withBom`
    * add column methods to DocumentBuilder
    * add data methods to DocumentBuilder
    * move instianting to factories
    * allow edit existing document
    * allow write single row
    * allow add multiple rows
    * move fileconfig from DocumentBuilder/Document to DocumentWriter
