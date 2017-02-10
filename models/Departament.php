<?php

require_once WEBROOT . 'libs/BaseModel.php';

class Departament extends BaseModel
{

    private $id;
    public $emri;
    public $pershkrimi;


    function __construct(array $dep = [])
    {
        parent::__construct();

        $this->emri = isset($dep['emri']) ? $dep['emri'] : null;
        $this->pershkrimi = isset($dep['pershkrimi']) ? $dep['pershkrimi'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {

        if (is_null($this->id)) {

            $new_id = $this->db->insert("departamentet", [

                "emri" => $this->emri,
                "pershkrimi" => $this->pershkrimi

            ]);

            return $new_id;

        } else {

            $rezultati = $this->db->update("departamentet", [

                "emri" => $this->emri,
                "pershkrimi" => $this->pershkrimi

            ], "id = {$this->id}");

            return $rezultati;
        }
    }


    public function delete()
    {
        $rezultati = $this->db->delete("departamentet", "id = {$this->id}");
        return $rezultati;
    }

    public static function getById(int $id)
    {

        $sql = "SELECT * FROM departamentet WHERE id = :id";

        $db = new Database();

        $rekord = $db->select($sql, [":id" => $id]);

        // $rekord eshte nje array me listen e rekordeve qe u kthye

        if (count($rekord)) {

            // Nese ekziston rekord me kete id, krijojme nje objekt perfaqesues per te

            $departament = new Departament();
            $departament->id = $rekord[0]["id"];
            $departament->emri = $rekord[0]["emri"];
            $departament->pershkrimi = $rekord[0]["pershkrimi"];

            return $departament;

        } else {
            return null;
        }
    }

    public static function getList(string $condition = "1")
    {

        $sql = "SELECT * FROM departamentet WHERE $condition";

        $db = new Database();

        $rekordet = $db->select($sql);

        // $rekordet eshte nje array me listen e rekordeve qe u kthye

        $departamentet = []; //Ky array do te mbaje listen e objekteve te tipit `Artikull`


        if (count($rekordet)) {


            foreach ($rekordet as $rekord) {
                //Per cdo rekord te kthyer nga databaza krijojme nje objekt:

                $departament = new Departament();
                $departament->id = $rekord["id"];
                $departament->emri = $rekord["emri"];
                $departament->pershkrimi = $rekord["pershkrimi"];

                // E shtojme objektin e krijuar ne array-n kryesor:

                array_push($departamentet, $departament);
            }

            //Kthejme listen e objekteve te tipit `Artikull`:

            return $departamentet;

        } else {
            return array();
        }
    }
}