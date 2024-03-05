<?php

defined('C5_EXECUTE') or die('Access Denied.');

# Load in the composer vendor files
require_once __DIR__ . "/../../../vendor/autoload.php";

# Try loading in environment info
try {
    (new \Symfony\Component\Dotenv\Dotenv('CONCRETE5_ENV'))
        ->usePutenv()->load(__DIR__ . '/../../../.env');
} catch (\Symfony\Component\Dotenv\Exception\PathException $e) {
    // Ignore missing file exception
}

# Add the vendor directory to the include path
ini_set('include_path', __DIR__ . "/../../../vendor" . PATH_SEPARATOR . get_include_path());
