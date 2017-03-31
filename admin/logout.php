<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";

AuthUser::logout();

header("Location: /login.php");
exit();