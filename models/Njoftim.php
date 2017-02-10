<?php

require_once WEBROOT . 'libs/BaseModel.php';

class Njoftim extends BaseModel
{

    private $id;
    public $titulli;
    public $pershkrimi;
    public $data;
    public $id_departament;


    function __construct(array $njoft = [])
    {
        parent::__construct();

        $this->titulli = isset($njoft['titulli']) ? $njoft['titulli'] : null;
        $this->pershkrimi = isset($njoft['pershkrimi']) ? $njoft['pershkrimi'] : null;
        $this->data = isset($njoft['data']) ? $njoft['data'] : null;
        $this->id_departament = isset($njoft['id_departament']) ? $njoft['id_departament'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {

        if (is_null($this->id)) {

            $new_id = $this->db->insert("njoftimet", [

                "titulli" => $this->titulli,
                "pershkrimi" => $this->pershkrimi,
                "data" => $this->data,
                "id_departament" => $this->id_departament

            ]);

            return $new_id;

        } else {

            $rezultati = $this->db->update("njoftimet", [

                "titulli" => $this->titulli,
                "pershkrimi" => $this->pershkrimi,
                "data" => $this->data,
                "id_departament" => $this->id_departament

            ], "id = {$this->id}");

            return $rezultati;
        }
    }


    public function delete()
    {
        $rezultati = $this->db->delete("njoftimet", "id = {$this->id}");
        return $rezultati;
    }

    public static function getById(int $id)
    {

        $sql = "SELECT * FROM njoftimet WHERE id = :id";

        $db = new Database();

        $rekord = $db->select($sql, [":id" => $id]);

        // $rekord eshte nje array me listen e rekordeve qe u kthye

        if (count($rekord)) {

            // Nese ekziston rekord me kete id, krijojme nje objekt perfaqesues per te

            $njoftim = new Njoftim();
            $njoftim->id = $rekord[0]["id"];
            $njoftim->titulli = $rekord[0]["titulli"];
            $njoftim->pershkrimi = $rekord[0]["pershkrimi"];
            $njoftim->data = $rekord[0]["data"];
            $njoftim->id_departament = $rekord[0]["id_departament"];

            return $njoftim;

        } else {
            return null;
        }
    }

    public static function getList(string $condition = "1")
    {

        $sql = "SELECT * FROM njoftimet WHERE $condition";

        $db = new Database();

        $rekordet = $db->select($sql);

        // $rekordet eshte nje array me listen e rekordeve qe u kthye

        $njoftimet = []; //Ky array do te mbaje listen e objekteve te tipit `Artikull`


        if (count($rekordet)) {


            foreach ($rekordet as $rekord) {
                //Per cdo rekord te kthyer nga databaza krijojme nje objekt:

                $njoftim = new Njoftim();
                $njoftim->id = $rekord["id"];
                $njoftim->titulli = $rekord["titulli"];
                $njoftim->pershkrimi = $rekord["pershkrimi"];
                $njoftim->data = $rekord["data"];
                $njoftim->id_departament = $rekord["id_departament"];

                // E shtojme objektin e krijuar ne array-n kryesor:

                array_push($njoftimet, $njoftim);
            }

            //Kthejme listen e objekteve te tipit `Artikull`:

            return $njoftimet;

        } else {
            return array();
        }
    }
}