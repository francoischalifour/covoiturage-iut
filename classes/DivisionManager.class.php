<?php
class DivisionManager{

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($division) {
        $requete = $this->db->prepare("INSERT INTO division VALUES (div_nom) VALUES (:nom);");
        $requete->bindValue(':nom', $division->getDivNum());

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllDivision() {
        $listeDivisions = array();
        $sql = "SELECT div_num, dep_nom FROM division ORDER BY div_num";
        $requete = $this->db->prepare($sql);
        $requete->execute;

        while ($division = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeDivisions[] = new Division($division);
        }

        $requete->closeCursor();

        return $listeDivisions;
    }

}