<?php

require_once "config.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Fakulteti i Teknologjise se Informacionit</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/index.php"><img src="/assets/img/logo.jpg"/></a>
            </div>
        </div>
    </div>
</header>


<div class="menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav id="navbar-top" class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse no-pd" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">

                                <li><a href="/index.php">KREU</a></li>
                                <li><a href="/about.php">RRETH FTI</a></li>
                                <li><a href="/notices.php">NJOFTIME</a></li>
                                <li><a href="/articles.php">LAJME</a></li>
                                <li><a href="/contact.php">KONTAKT</a></li>
                            </ul>

                            <form method="post" action="/articles.php" class="navbar-form navbar-right">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input input-sm"
                                           placeholder="Kerko">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/login.php">HYR</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>