<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";
require_once WEBROOT . "models/Njoftim.php";
require_once WEBROOT . "models/Perdorues.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

$user_logged = Perdorues::getById(AuthUser::get()["id"]);

if ($user_logged->isAdmin()) {
    $njoftimet = Njoftim::getList();
} else {
    $njoftimet = Njoftim::getList("id_departament = {$user_logged->id_departament}");
}

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

                    <h3 class="pg-title">Lista e Njoftimeve
                        <a href="/admin/notice_create.php" class="btn btn-default btn-xs pull-right"><i
                                    class="fa fa-plus"></i></a>
                    </h3>

                    <div class="pg-description">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>Titulli</th>
                                <th>Pershkrimi</th>
                                <th>Data</th>
                                <th>Veprimi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($njoftimet as $njoftim) { ?>
                                <tr>
                                    <td><?= $njoftim->titulli ?></td>
                                    <td><?= $njoftim->pershkrimi ?></td>
                                    <td><?= $njoftim->data ?></td>
                                    <td>
                                        <a class="btn btn-info"
                                           href="/admin/notice_edit.php?id=<?= $njoftim->getId(); ?>"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger"
                                           href="/admin/notice_delete.php?id=<?= $njoftim->getId(); ?>"><i
                                                    class="fa fa-times"></i></a>
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