<?php

namespace App\config\loaders;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

function bootstrap()
{
    $dbPath = __DIR__ . '/../../db.sqlite';
    touch($dbPath);

    $capsule = new Capsule();
    $capsule->addConnection([
        'driver'    => 'pgsql',
        'host'      => 'localhost',
        'database'  => 'eloquent',
        'username'  => 'mad',
        'password'  => '799142',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    $capsule->setEventDispatcher(new Dispatcher(new Container()));

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();

    $capsule->connection()->listen(function ($query) {
        echo "\n";
        var_dump($query->sql);
    });

    return ['capsule' => $capsule];
}