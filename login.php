<?php
require_once "config.php";
require_once "libs/AuthUser.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $perdorues = AuthUser::authenticate($email, md5($password));

    if ($perdorues !== false) {

        AuthUser::save($perdorues->toArray());
        header("Location: admin/profile.php");
        exit();

    } else {

        $error_msg = "Kredenciale te gabuara!";

    }
}

include "header.php"

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 left-content">

                    <?php if (isset($error_msg)) { ?>
                        <p class="alert alert-danger text-center"><?php echo $error_msg; ?></p>
                    <?php } ?>

                    <form method="POST">
                        <div class="login-block">
                            <h1>Login</h1>
                            <input type="text" name="email" placeholder="Email" id="email"/>
                            <input type="password" name="password" placeholder="Password" id="password"/>
                            <button name="login">Hyr</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php

include "footer.php"

?>