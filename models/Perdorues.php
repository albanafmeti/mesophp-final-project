<?php

require_once WEBROOT . 'libs/BaseModel.php';

class Perdorues extends BaseModel
{

    private $id;
    public $emri;
    public $email;
    public $password;
    public $tipi = 1;
    public $id_departament;

    function __construct(array $user = [])
    {
        parent::__construct();

        $this->emri = isset($user['emri']) ? $user['emri'] : null;
        $this->email = isset($user['email']) ? $user['email'] : null;
        $this->password = isset($user['password']) ? $user['password'] : null;
        $this->tipi = isset($user['tipi']) ? $user['tipi'] : null;
        $this->id_departament = isset($user['id_departament']) ? $user['id_departament'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function save()
    {

        if (is_null($this->id)) {

            $new_id = $this->db->insert("perdoruesit", [

                "emri" => $this->emri,
                "email" => $this->email,
                "password" => $this->password,
                "tipi" => $this->tipi,
                "id_departament" => $this->id_departament

            ]);

            return $new_id;

        } else {

            $rezultati = $this->db->update("perdoruesit", [

                "emri" => $this->emri,
                "email" => $this->email,
                "password" => $this->password,
                "tipi" => $this->tipi,
                "id_departament" => $this->id_departament

            ], "id = {$this->id}");

            return $rezultati;
        }
    }


    public function delete()
    {
        $rezultati = $this->db->delete("perdoruesit", "id = {$this->id}");
        return $rezultati;
    }

    public static function getById(int $id)
    {

        $sql = "SELECT * FROM perdoruesit WHERE id = :id";

        $db = new Database();

        $rekord = $db->select($sql, [":id" => $id]);

        // $rekord eshte nje array me listen e rekordeve qe u kthye

        if (count($rekord)) {

            // Krijojme nje objekt perfaqesues per rekordin qe u kthye nga databaza

            $perdorues = new Perdorues();
            $perdorues->id = $rekord[0]["id"];
            $perdorues->emri = $rekord[0]["emri"];
            $perdorues->email = $rekord[0]["email"];
            $perdorues->password = $rekord[0]["password"];
            $perdorues->tipi = $rekord[0]["tipi"];
            $perdorues->id_departament = $rekord[0]["id_departament"];

            return $perdorues;

        } else {
            return null;
        }
    }

    public static function getList(string $condition = "1")
    {

        $sql = "SELECT * FROM perdoruesit WHERE $condition";

        $db = new Database();

        $rekordet = $db->select($sql);

        // $rekordet eshte nje array me listen e rekordeve qe u kthye

        $perdoruesit = [];  //Ky array do te mbaje listen e objekteve te tipit `Perdorues`


        if (count($rekordet)) {


            foreach ($rekordet as $rekord) {
                //Per cdo rekord te kthyer nga databaza krijojme nje objekt:


                $perdorues = new Perdorues();
                $perdorues->id = $rekord["id"];
                $perdorues->emri = $rekord["emri"];
                $perdorues->email = $rekord["email"];
                $perdorues->password = $rekord["password"];
                $perdorues->tipi = $rekord["tipi"];
                $perdorues->id_departament = $rekord["id_departament"];

                // E shtojme objektin e krijuar ne array-n kryesor:

                array_push($perdoruesit, $perdorues);
            }

            //Kthejme listen e objekteve te tipit `Perdorues`:

            return $perdoruesit;

        } else {
            return array();
        }
    }

    public function toArray() {
        $perdorues = [];
        $perdorues["id"] = $this->id;
        $perdorues["emri"] = $this->emri;
        $perdorues["email"] = $this->email;
        $perdorues["password"] = $this->password;
        $perdorues["tipi"] = $this->tipi;
        $perdorues["id_departament"] = $this->id_departament;
        return $perdorues;
    }

    public function isAdmin()
    {
        if ($this->tipi == 0) {
            return true;
        }
        return false;
    }

}