<?php

require_once WEBROOT . "models/Perdorues.php";

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

            $perdorues->setId($rezultati[0]["id"]);

            return $perdorues;
        } else {
            return false;
        }
    }

    public static function save(Array $perdorues)
    {
        Session::set("user_auth", $perdorues);
    }

    public static function is_logged()
    {
        if (is_null(self::get())) {
            return false;
        } else {
            return true;
        }

    }

    public static function logout()
    {
        Session::clear("user_auth");
    }

    public static function get()
    {
        return Session::get("user_auth");
    }
}