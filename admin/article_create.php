<?php

include "../header.php"

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

                        <form method="post">
                            <div class="form-group">
                                <label for="titulli">Titulli:</label>
                                <input type="text" name="titulli" class="form-control" id="titulli">
                            </div>
                            <div class="form-group">
                                <label for="pershkrimi">Pershkrimi:</label>
                                <textarea name="pershkrimi" class="form-control" id="pershkrimi"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Ruaj</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include "../footer.php"

?>