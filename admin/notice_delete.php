<?php
require_once "config.php";
require_once "../libs/AuthUser.php";
require_once "../models/Njoftim.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

if (!isset($_GET["id"])) {
    header("Location: /admin/notice_list.php");
}

$njoftim = Njoftim::getById($_GET['id']);

if ($njoftim->id_departament == AuthUser::get()["id_departament"]) {
    $njoftim->delete();
}
header("Location: /admin/notice_list.php");