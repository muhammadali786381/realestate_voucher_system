<?php
//pre need pages
include_once __DIR__.'/config/config.php';
include_once __DIR__.'/includes/processing.php';
include_once __DIR__.'/themes/default/head.php';

if(!isLogin()){
    RedirectURL(BASE_URL."login.php");
}

//working pages
include_once __DIR__.'/themes/default/header.php';

//get request responce 
include_once __DIR__.'/includes/get_request.php'; 

?>







<?php

include_once __DIR__.'/themes/default/footer.php';

?>