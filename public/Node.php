<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

class Node
{
    private ?self $next = null;
    private $value = null;

    public function __construct($value, Node $node = null)
    {
        $this->next = $node;
        $this->value = $value;
    }

    public function getNext(): ?self
    {
        return $this->next;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
