<?php
require_once "config.php";
require_once WEBROOT . "libs/AuthUser.php";

if (!AuthUser::is_logged()) {
    header("Location: /login.php");
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

                    <h3 class="pg-title">Paneli i Administrimit</h3>

                    <div class="pg-description">

                        <h3 class="text-center">Mire se Erdhe</h3>
                        <hr style="border-color: #860000">
                        <h3 class="text-center">
                            <strong>
                                <?php
                                $logged_user = AuthUser::get();
                                echo $logged_user["emri"];
                                ?>
                            </strong>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include WEBROOT . "footer.php"

?>