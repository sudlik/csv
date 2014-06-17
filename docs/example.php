<?php

use Csv\Builder\DocumentBuilder;
use Csv\Collection\ColumnCollection;
use Csv\Collection\NameCollection;
use Csv\Collection\RowCollection;
use Csv\Column;
use Csv\Content;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Enum\Escape;
use Csv\Name;
use Csv\Position;
use Csv\Row;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

(new DocumentBuilder('example', 'test.csv'))
    ->charset('UTF-8')
    ->delimiter(';')
    ->enclosure('"')
    ->escape('\\')
    ->header(true)

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

    // Set column data and add missed columns
    ->column(['yet another', 'value'], 1)
    // csv output:
    //Number,Second,Name
    //,yet another,
    //,value,

    // Set column data
    ->column([1 => 'foobar'], 2)
    // csv output:
    //Number,Second,Name
    //,yet another,
    //,value,foobar

    // Set column data
    ->columns([[['hello', 'world'], 2]])
    // csv output:
    //Number,Second,Name
    //,yet another,hello
    //,value,world

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

    // Set row
    ->rows([[2 => 'z'], 2])
    // csv output:
    //Number,Second,Name
    //,yet another,hello
    //1,2,3
    //,,z

    ->getDocument()
    ->write();

(new DocumentBuilder())
    ->delimiter(new Delimiter(Delimiter::SEMICOLON))
    ->enclosure(new Enclosure(Enclosure::DOUBLE_QUOTES))
    ->escape(new Escape(Escape::BACKSLASH))
    ->charset(new Charset(Charset::UTF8))
    ->header(true)
    ->name(new Cell(new Content('Index')))
    ->name(new Cell(new Content('Number'), new Position(0)))
    ->name(new Cell(new Content('Description'), new Position(1)))
    ->names(new NameCollection(new Cell(new Content('Name'))))
    ->names(new NameCollection(new Cell(new Content('Second'), new Position(1))))
    ->column(
        (new Column(new Position(1)))
            ->add(new Cell(new Content('yet another')))
            ->add(new Cell(new Content('value')))
    )
    ->column((new Column(new Position(2)))->add(new Cell(new Content('yet another'), new Position(1))))
    ->columns(
        (new ColumnCollection)
            ->add(
                (new Column(new Content('Firstname'), new Position(2)))
                    ->add(new Cell(new Content('hello')))
                    ->add(new Cell(new Content('world')))
            )
    )
    ->row((new Row)->add(new Cell(new Content('a')))->add(new Cell(new Content('b')))->add(new Cell(new Content('c'))))
    ->row(
        (new Row(new Position(0)))
            ->add(new Cell(new Content(1)))
            ->add(new Cell(new Content(2)))
            ->add(new Cell(new Content(3)))
    )
    ->rows((new RowCollection)->add((new Row(new Position(2)))->add(new Cell(new Content('z'), new Position(4)))));