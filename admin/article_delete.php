<?php
require_once "config.php";
require_once "../libs/AuthUser.php";
require_once "../models/Artikull.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

if (!isset($_GET["id"])) {
    header("Location: /admin/article_list.php");
}

$artikull = Artikull::getById($_GET['id']);

if ($artikull->id_departament == AuthUser::get()["id_departament"]) {
    $artikull->delete();
}
header("Location: /admin/article_list.php");