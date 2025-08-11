<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->boot();

try {
    $connection = \Illuminate\Support\Facades\DB::connection();
    $connection->getPdo();
    echo "Successfully connected to the database!".PHP_EOL;
    echo "Database name: " . $connection->getDatabaseName() . PHP_EOL;
    echo "Connection name: " . $connection->getName() . PHP_EOL;
} catch (\Exception $e) {
    echo "Failed to connect to the database. Error: " . $e->getMessage() . PHP_EOL;
}
