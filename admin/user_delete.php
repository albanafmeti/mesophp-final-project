<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";
require_once WEBROOT . "models/Perdorues.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

//Kjo faqe mund te administrohet vetem nga administratoret dhe jo pedagoget
$logged_user = Perdorues::getById(AuthUser::get()["id"]);
if (!$logged_user->isAdmin()) {
    header("Location: /admin/profile.php");
}

if (!isset($_GET["id"])) {
    header("Location: /admin/user_list.php");
}

$perdorues = Perdorues::getById($_GET['id']);
$perdorues->delete();
header("Location: /admin/user_list.php");