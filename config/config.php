<?php
//error reporting into file
ini_set('display_errors', 1); // 0 change to 1 for display error
ini_set('display_startup_errors', 1); // 0 change to 1 for display error
ini_set('error_log',dirname(__FILE__).'/error_log.txt');
error_reporting(E_ALL);

//set site url example (http://yourdomain.com/);
define("BASE_URL", "http://localhost/voucher_system/");

//in case online web server leave blank
define("BASE_PATH", "voucher_system/"); // lcoal setup case "serverpath/" //in case online remain blank as ""

session_start();

