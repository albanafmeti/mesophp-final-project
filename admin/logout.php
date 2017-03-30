<?php
require_once "config.php";
show_reporting();
require_once "../libs/AuthUser.php";

AuthUser::logout();

header("Location: ../login.php");
exit();