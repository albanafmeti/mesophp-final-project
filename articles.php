<?php
require_once "config.php";
require_once WEBROOT . "models/Artikull.php";

if (isset($_POST["kerko"])) {
    $kerkesa = $_POST["kerkesa"];
    $artikujt = Artikull::getList("titulli LIKE '%$kerkesa%' OR pershkrimi LIKE '%$kerkesa%'");
} else {
    header("Location: /index.php");
}

include "header.php";

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 left-content">
                    <div class="row">
                        <h5 class="side-arkiva">LAJME TE KERKUARA</h5>

                        <?php foreach ($artikujt as $i => $artik) { ?>

                            <div class="col-md-4 news-item">
                                <h3 class="news-title"><?php echo $artik->titulli; ?></h3>
                                <p class="news-content"><a href="#"><?php echo $artik->pershkrimi; ?></a></p>
                            </div>

                        <?php } ?>

                        <?
                        if (count($artikujt) == 0) {
                            echo "<p class='text-center'>Nuk ka artikuj per kerkimin e bere.</p>";
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php

include "footer.php";

?>