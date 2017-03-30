<?php
require_once "config.php";
require_once "../libs/AuthUser.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

if (!isset($_GET["id"])) {
    header("Location: /admin/user_list.php");
}

$perdorues = Perdorues::getById($_GET['id']);
$perdorues->delete();
header("Location: /admin/user_list.php");