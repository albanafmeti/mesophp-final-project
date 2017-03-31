<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";
require_once WEBROOT . "models/Perdorues.php";
require_once WEBROOT . "models/Departament.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

//Kjo faqe mund te administrohet vetem nga administratoret dhe jo pedagoget
$logged_user = Perdorues::getById(AuthUser::get()["id"]);
if (!$logged_user->isAdmin()) {
    header("Location: /admin/profile.php");
}

$perdoruesit = Perdorues::getList();

include WEBROOT . "header.php"

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-3 pg-left-content">
                    <?php

                    include "sidebar.php";

                    ?>
                </div>
                <div class="col-sm-9 no-pd pg-content">

                    <h3 class="pg-title">Lista e Perdoruesve
                        <a href="/admin/user_create.php" class="btn btn-default btn-xs pull-right"><i
                                    class="fa fa-plus"></i></a>
                    </h3>

                    <div class="pg-description">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>Emri</th>
                                <th>Email</th>
                                <th>Tipi</th>
                                <th>Departamenti</th>
                                <th>Veprimi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($perdoruesit as $perdorues) { ?>
                                <tr>
                                    <td><?= $perdorues->emri ?></td>
                                    <td><?= $perdorues->email ?></td>
                                    <td><?= ($perdorues->tipi == "0") ? "admin" : "pedagog"; ?></td>
                                    <td><?
                                        $departament = Departament::getById($perdorues->id_departament);
                                        echo $departament->emri;
                                        ?></td>
                                    <td>
                                        <a class="btn btn-info" href="/admin/user_edit.php?id=<?= $perdorues->getId(); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="/admin/user_delete.php?id=<?= $perdorues->getId(); ?>"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include WEBROOT . "footer.php"

?>