<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/services/AdminService.php';
Flight::register('adminService', 'AdminService');
require_once __DIR__ . '/routes/AdminRoute.php';

Flight::route('GET /test', function(){
    echo "Hello from Test route";
});

Flight::start();



?>