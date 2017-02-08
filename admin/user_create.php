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

                    <h3 class="pg-title">Perdorues i ri</h3>

                    <div class="pg-description col-md-6 col-md-offset-3">

                        <form method="post">
                            <div class="form-group">
                                <label for="emri">Emri:</label>
                                <input type="text" name="emri" class="form-control" id="emri">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email"/>
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
                                    <label><input type="radio" name="tipi"> Admin</label>
                                    <label><input type="radio" name="tipi"> Pedagog</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Departamenti</label>
                                <select class="form-control" name="id_departament">
                                    <option>Departamenti i Inxhinierise Informatike</option>
                                    <option>Departamenti i Elektronikes dhe Telekomunikacionit</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-default pull-right">Ruaj</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include "../footer.php"

?>