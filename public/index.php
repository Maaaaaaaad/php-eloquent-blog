<?php

namespace App\KeyValueFunctions;

/*require __DIR__ . '/../vendor/autoload.php';*/

require_once __DIR__ . '/../src/pages/StaticPage.php';

use App\pages\StaticPage;

$id = 3;
$page = new StaticPage($id);
$page->render();
echo $page->id($id);