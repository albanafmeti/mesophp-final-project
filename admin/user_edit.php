<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";
require_once WEBROOT . "models/Departament.php";
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

$perdorues = Perdorues::getById($_GET["id"]);

$emri = isset($_POST['emri']) ? $_POST['emri'] : $perdorues->emri;
$email = isset($_POST['email']) ? $_POST['email'] : $perdorues->email;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$password_conf = isset($_POST['password_conf']) ? $_POST['password_conf'] : null;
$tipi = isset($_POST['tipi']) ? $_POST['tipi'] : $perdorues->tipi;
$id_departament = isset($_POST['id_departament']) ? $_POST['id_departament'] : $perdorues->id_departament;

$departamentet = Departament::getList();

if (isset($_POST['ruaj'])) {

    $error_msg = null;
    if ($emri == "") {
        $error_msg = "Emri eshte fushe e detyrueshme.";
    } elseif ($email == "") {
        $error_msg = "Email eshte fushe e detyrueshme.";
    } elseif ($tipi == "") {
        $error_msg = "Tipi eshte fushe e detyrueshme.";
    } elseif ($id_departament == "") {
        $error_msg = "Departamenti eshte fushe e detyrueshme.";
    } elseif ($password != "" && $password != $password_conf) {
        $error_msg = "Ju lutem, konfirmoni passwordin ne menyre te sakte.";
    }

    if (is_null($error_msg)) {

        $perdorues->emri = $emri;
        $perdorues->email = $email;

        if (!is_null($password)) {
            $perdorues->password = md5($password);
        }

        $perdorues->tipi = $tipi;
        $perdorues->id_departament = $id_departament;
        $perdorues->save();

        $success_msg = "Perdoruesi u modifikua me sukses.";
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

                    <h3 class="pg-title">Modifiko Perdorues</h3>

                    <div class="pg-description col-md-6 col-md-offset-3">

                        <?php if (isset($error_msg)) { ?>
                            <p class="alert alert-danger text-center"><?php echo $error_msg; ?></p>
                        <?php } ?>

                        <?php if (isset($success_msg)) { ?>
                            <p class="alert alert-success text-center"><?php echo $success_msg; ?></p>
                        <?php } ?>

                        <form method="post">
                            <div class="form-group">
                                <label for="emri">Emri:</label>
                                <input type="text" name="emri" class="form-control" id="emri"
                                       value="<?php echo $emri; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       value="<?php echo $email; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" id="password"/>
                            </div>
                            <div class="form-group">
                                <label for="password_c">Konfirmo:</label>
                                <input type="password" name="password_conf" class="form-control" id="password_c"/>
                            </div>

                            <div class="form-group">
                                <label>Tipi</label>
                                <div class="checkbox">
                                    <label><input type="radio" value="0"
                                                  name="tipi" <?= ($tipi == "0") ? "checked" : ""; ?>>
                                        Admin</label>
                                    <label><input type="radio" value="1"
                                                  name="tipi" <?= ($tipi == "1") ? "checked" : ""; ?>>
                                        Pedagog</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Departamenti</label>
                                <select class="form-control" name="id_departament">
                                    <?php foreach ($departamentet as $dep) { ?>
                                        <option value="<?= $dep->getId() ?>" <?= ($id_departament == $dep->getId()) ? "selected" : ""; ?>><?= $dep->emri ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-default pull-right" name="ruaj">Ruaj</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include WEBROOT . "footer.php"

?>