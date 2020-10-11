<?php
require __DIR__ . '/vendor/autoload.php';
require(dirname(__FILE__) . '/config/config.php');

use FirebaseBackend\API;
use FirebaseBackend\CloudMessaging;

// ERROR HANDLING
if (SHOW_ERRORS) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// SET API METHOD
$apiMethod = null;

if (isset($_GET['method'])) $apiMethod = $_GET['method'];

if (!isset($apiMethod)) {
    API::response(false, null, ['You must give an API method']);
    return;
}

// CALL API METHOD
if ($apiMethod === 'sendMulticast') {
    CloudMessaging::sendMulticast();
} else {
    API::response(false, null, ['Given method doesnt exist']);
}
