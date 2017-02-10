<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config.php";
require_once "models/Departament.php";
require_once "models/Njoftim.php";
require_once "models/Artikull.php";

$departamentet = Departament::getList();

$id_departament = "";
$kushti = "1 LIMIT 4";

if (isset($_GET['id_dep']) && is_numeric($_GET['id_dep'])) {
    $id_departament = $_GET['id_dep'];
    $kushti = "id_departament = {$_GET['id_dep']} LIMIT 4";
}

$njoftimet = Njoftim::getList($kushti);
$artikujt = Artikull::getList($kushti);

include "header.php"

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 left-content">

                    <div class="main-image">
                        <img src="/assets/img/studentet.jpg"/>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-md-4 side-options">
                            <ul>
                                <?php foreach ($departamentet as $dep) { ?>
                                    <li class="<?php echo ($id_departament == $dep->getId()) ? "active" : ""; ?>"><a
                                            href="/index.php?id_dep=<?php echo $dep->getId(); ?>"><?php echo $dep->emri; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="col-md-4 news-row">
                            <div class="border"></div>
                            <?php foreach ($njoftimet as $i => $njof) {

                                if ($i % 2 != 0) {
                                    continue;
                                }

                                ?>

                                <div class="news-item">
                                    <h3 class="news-title"><?php echo $njof->titulli; ?></h3>
                                    <p class="news-content"><a href="#"><?php echo $njof->pershkrimi; ?></a></p>
                                </div>


                            <?php } ?>
                        </div>

                        <div class="col-md-4 news-row no-pd-left">
                            <div class="border"></div>

                            <?php foreach ($njoftimet as $i => $njof) {

                                if ($i % 2 == 0) {
                                    continue;
                                }

                                ?>

                                <div class="news-item">
                                    <h3 class="news-title"><?php echo $njof->titulli; ?></h3>
                                    <p class="news-content"><a href="#"><?php echo $njof->pershkrimi; ?></a></p>
                                </div>


                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 no-pd-left side-archive">
                    <h5 class="side-arkiva">LAJME</h5>

                    <?php foreach ($artikujt as $i => $artik) { ?>

                        <div class="col-md-12 news-item">
                            <h3 class="news-title"><?php echo $artik->titulli; ?></h3>
                            <p class="news-content"><a href="#"><?php echo $artik->pershkrimi; ?></a></p>
                        </div>

                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

<?php

include "footer.php"

?>