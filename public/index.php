<?php

namespace App\KeyValueFunctions;

require __DIR__ . '/../vendor/autoload.php';

use App\InMemoryKV;

function swapKeyValue($obj)
{
    $res = $obj->toArray();
    foreach ($res as $key => $value) {
        $obj->unset($key);
    }

    foreach ($res as $key => $value) {
        $obj->set($value, $key);
    }
    return $obj;
}


$map = new InMemoryKV(['foo' => 'bar', 'bar' => 'zoo']);



dump(swapKeyValue($map));

