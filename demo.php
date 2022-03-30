<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Klaviyo\Client;

$client = new Client($argv[1]);

print_r($client->Metrics->getMetrics());