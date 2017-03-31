<?php
require_once "config.php";
require_once "libs/AuthUser.php";

include "header.php"

?>

    <div id="content">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 left-content">

                    <div class="col-md-8 col-md-offset-2">
                        <form role="form" id="contact" method="POST">


                            <fieldset class="kontakt">
                                <legend>Na kontaktoni</legend>

                                <span>* Fushat e detyruara</span>

                                <div class="form-group">
                                    <label>Emri juaj: *</label>
                                    <input type="text" class="form-control " name="emri" required>
                                </div>
                                <div class="form-group">
                                    <label>E-mail juaj: *</label>
                                    <input type="email" class="form-control " name="email" required>
                                </div>

                                <div class="form-group">
                                    <label>Mesazhi juaj: *</label>
                                    <textarea name="mesazhi" class="form-control" rows="5"></textarea>
                                </div>

                                <input type="submit" name="dergo" value="Dergo" class="btn btn-default"/>

                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php

include "footer.php"

?>