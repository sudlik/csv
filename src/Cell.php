<?php

namespace Csv;

class Cell
{
    private $content;
    
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function __toString()
    {
        return (string)$this->content->getValue();
    }
}