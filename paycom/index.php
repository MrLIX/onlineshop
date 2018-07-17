<?php
// Enable to debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('Asia/Tashkent');
}

require_once 'vendor/autoload.php';
require_once 'functions.php';

use Paycom\Application;

const CONFIG_FILE = 'paycom.config.php';

// load configuration
$paycomConfig = require_once CONFIG_FILE;

$application = new Application($paycomConfig);
$application->run();
