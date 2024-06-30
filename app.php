<?php

declare(strict_types=1);

use TestTask\Service\ContentService;

require_once __DIR__ . '/vendor/autoload.php';

/** Load ENV vars */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** Initialize service with business logic */
$processDataService = new ContentService();

/** read input vars */
$inputFile = __DIR__ . '/'. $argv[1];

/** run process */
$result = $processDataService->processContent($inputFile);

/** show result */
foreach ($result as $value) {
    echo $value . "\n";
}