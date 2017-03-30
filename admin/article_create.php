<?php

require_once "config.php";
require_once "../libs/AuthUser.php";
require_once "../models/Artikull.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
}

$titulli = isset($_POST['titulli']) ? $_POST['titulli'] : null;
$pershkrimi = isset($_POST['pershkrimi']) ? $_POST['pershkrimi'] : null;


if (isset($_POST['ruaj'])) {

    $error_msg = null;
    if ($titulli == "") {
        $error_msg = "Titulli eshte fushe e detyrueshme.";
    } elseif ($pershkrimi == "") {
        $error_msg = "Pershkrimi eshte fushe e detyrueshme.";
    }

    if (is_null($error_msg)) {

        $artikull = new Artikull();
        $artikull->titulli = $titulli;
        $artikull->pershkrimi = $pershkrimi;
        $artikull->data = date("Y-m-d");
        $artikull->id_departament = AuthUser::get()["id_departament"];
        $artikull->save();

        header("Location: /admin/article_list.php");
        exit();
    }
}

include "header.php"

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

                    <h3 class="pg-title">Lajm i ri</h3>

                    <div class="pg-description">

                        <?php if (isset($error_msg)) { ?>
                            <p class="alert alert-danger text-center"><?php echo $error_msg; ?></p>
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

include "../footer.php"

?>