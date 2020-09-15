<?php

use Weather\App;

require __DIR__ . '/../bootstrap/bootstrap.php';

try {
    $app = new App();
    $app->run();
} catch (Throwable $throwable) {
    echo $throwable->getMessage() . PHP_EOL;
}
