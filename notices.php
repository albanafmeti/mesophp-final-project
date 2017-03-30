<?php
require_once "config.php";
require_once "models/Departament.php";
require_once "models/Njoftim.php";
require_once "models/Artikull.php";
require_once "libs/AuthUser.php";

$departamentet = Departament::getList();

$id_departament = "";
$kushti = "1 LIMIT 4";

if (isset($_GET['id_dep']) && is_numeric($_GET['id_dep'])) {
    $id_departament = $_GET['id_dep'];
    $kushti = "id_departament = {$_GET['id_dep']} LIMIT 4";
}

$njoftimet = Njoftim::getList($kushti);

include "header.php"

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 left-content">
                    <div class="row">
                        <h5 class="side-arkiva">NJOFTIME</h5>
                        <div class="col-sm-12 col-md-3 side-options">
                            <ul>
                                <?php foreach ($departamentet as $dep) { ?>
                                    <li class="<?php echo ($id_departament == $dep->getId()) ? "active" : ""; ?>"><a
                                            href="/notices.php?id_dep=<?php echo $dep->getId(); ?>"><?php echo $dep->emri; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <?php foreach ($njoftimet as $i => $njof) { ?>

                            <div class="news-item col-md-3">
                                <h3 class="news-title"><?php echo $njof->titulli; ?></h3>
                                <p class="news-content"><a href="#"><?php echo $njof->pershkrimi; ?></a></p>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include "footer.php"

?>