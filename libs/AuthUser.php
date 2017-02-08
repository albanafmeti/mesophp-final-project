<?php

require_once "../models/Perdorues.php";

class AuthUser
{

    public static function authenticate(string $email, string $password)
    {

        $sql = "SELECT * FROM perdoruesit WHERE email = :email AND password = :password";

        $db = new Database();

        $rezultati = $db->select($sql, [
            ":email" => $email,
            ":password" => $password
        ]);

        if (count($rezultati)) {

            $perdorues = new Perdorues([
                "emri" => $rezultati[0]["emri"],
                "email" => $rezultati[0]["email"],
                "tipi" => $rezultati[0]["tipi"],
                "id_departament" => $rezultati[0]["id_departament"],
            ]);

            return $perdorues;
        } else {
            return false;
        }
    }

    public static function save(Perdorues $perdorues)
    {
        Session::set("auth", $perdorues);
    }

    public static function is_logged()
    {

        if (is_null(Session::get("auth"))) {
            return false;
        } else {
            return true;
        }

    }

    public static function logout()
    {
        Session::clear("auth");
    }

    public function get()
    {
        return Session::get("auth");
    }
}