<?php

define("WEBROOT", "");

require_once WEBROOT . "libs/Session.php";
Session::start();

function show_reporting()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}