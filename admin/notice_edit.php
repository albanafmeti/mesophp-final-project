<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";
require_once WEBROOT . "models/Njoftim.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

if (!isset($_GET["id"])) {
    header("Location: /admin/notice_list.php");
}

$njoftim = Njoftim::getById($_GET["id"]);

$titulli = isset($_POST['titulli']) ? $_POST['titulli'] : $njoftim->titulli;
$pershkrimi = isset($_POST['pershkrimi']) ? $_POST['pershkrimi'] : $njoftim->pershkrimi;


if (isset($_POST['ruaj'])) {

    $error_msg = null;
    if ($titulli == "") {
        $error_msg = "Titulli eshte fushe e detyrueshme.";
    } elseif ($pershkrimi == "") {
        $error_msg = "Pershkrimi eshte fushe e detyrueshme.";
    }

    if (is_null($error_msg)) {

        $njoftim->titulli = $titulli;
        $njoftim->pershkrimi = $pershkrimi;
        $njoftim->save();

        $success_msg = "Njoftimi u modifikua me sukses.";
    }
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

                    <h3 class="pg-title">Modifiko Njoftim</h3>

                    <div class="pg-description">

                        <?php if (isset($error_msg)) { ?>
                            <p class="alert alert-danger text-center"><?php echo $error_msg; ?></p>
                        <?php } ?>

                        <?php if (isset($success_msg)) { ?>
                            <p class="alert alert-success text-center"><?php echo $success_msg; ?></p>
                        <?php } ?>

                        <form method="post">
                            <div class="form-group">
                                <label for="titulli">Titulli:</label>
                                <input type="text" name="titulli" class="form-control" id="titulli"
                                       value="<?= $titulli ?>">
                            </div>
                            <div class="form-group">
                                <label for="pershkrimi">Pershkrimi:</label>
                                <textarea name="pershkrimi" class="form-control"
                                          id="pershkrimi"><?= $pershkrimi ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-default" name="ruaj">Ruaj</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include WEBROOT . "footer.php"

?>