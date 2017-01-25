<?php
defined('C5_EXECUTE') or die('Access Denied.');

# Load in the composer vendor files
require_once __DIR__ . "/../../../vendor/autoload.php";

# Add the vendor directory to the include path
ini_set('include_path', __DIR__ . "/../../vendor" . PATH_SEPARATOR . get_include_path());

