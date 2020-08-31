<?php
include_once __DIR__."/config/config.php";
include_once __DIR__."/includes/general_functions.php";
session_destroy();
RedirectURL(BASE_URL."login.php");

