<?php

require __DIR__ . '/../vendor/autoload.php';
require 'public/LinkedList.php';
require 'public/Node.php';

use App\Node;


$list = new Node(1, new Node(2, new Node(3)));


function revers(Node $node)
{
    $res = $node;
    if ($res->getNext() != null) {
        $res = revers($res->getNext());

    }

    return $res;
}

revers($list);

