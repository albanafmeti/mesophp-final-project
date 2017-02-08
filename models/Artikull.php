<?php
//Importimi i skedareve te nevojshem:
require_once '../libs/BaseModel.php';

class Artikull extends BaseModel
{

    private $id;
    public $titulli;
    public $pershkrimi;
    public $data;
    public $id_departament;


    function __construct(array $artik = [])
    {
        parent::__construct();

        $this->titulli = isset($artik['titulli']) ? $artik['titulli'] : null;
        $this->pershkrimi = isset($artik['pershkrimi']) ? $artik['pershkrimi'] : null;
        $this->data = isset($artik['data']) ? $artik['data'] : null;
        $this->id_departament = isset($artik['id_departament']) ? $artik['id_departament'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {

        if (is_null($this->id)) {

            $new_id = $this->db->insert("artikujt", [

                "titulli" => $this->titulli,
                "pershkrimi" => $this->pershkrimi,
                "data" => $this->data,
                "id_departament" => $this->id_departament

            ]);

            return $new_id;

        } else {

            $rezultati = $this->db->update("artikujt", [

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
        $rezultati = $this->db->delete("artikujt", "id = {$this->id}");
        return $rezultati;
    }

    public static function getById(int $id)
    {

        $sql = "SELECT * FROM artikujt WHERE id = :id";

        $db = new Database();

        $rekord = $db->select($sql, [":id" => $id]);

        // $rekord eshte nje array me listen e rekordeve qe u kthye

        if (count($rekord)) {

            // Nese ekziston rekord me kete id, krijojme nje objekt perfaqesues per te

            $artikull = new Artikull();
            $artikull->id = $rekord[0]["id"];
            $artikull->titulli = $rekord[0]["titulli"];
            $artikull->pershkrimi = $rekord[0]["pershkrimi"];
            $artikull->data = $rekord[0]["data"];
            $artikull->id_departament = $rekord[0]["id_departament"];

            return $artikull;

        } else {
            return null;
        }
    }

    public static function getList(string $condition = 1)
    {

        $sql = "SELECT * FROM artikujt WHERE $condition";

        $db = new Database();

        $rekordet = $db->select($sql);

        // $rekordet eshte nje array me listen e rekordeve qe u kthye

        $artikujt = []; //Ky array do te mbaje listen e objekteve te tipit `Artikull`


        if (count($rekordet)) {


            foreach ($rekordet as $rekord) {
                //Per cdo rekord te kthyer nga databaza krijojme nje objekt:

                $artikull = new Artikull();
                $artikull->id = $rekord["id"];
                $artikull->titulli = $rekord["titulli"];
                $artikull->pershkrimi = $rekord["pershkrimi"];
                $artikull->data = $rekord["data"];
                $artikull->id_departament = $rekord["id_departament"];

                // E shtojme objektin e krijuar ne array-n kryesor:

                array_push($artikujt, $artikull);
            }

            //Kthejme listen e objekteve te tipit `Artikull`:

            return $artikujt;

        } else {
            return array();
        }
    }
}