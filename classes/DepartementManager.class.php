<?php
class DepartementManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($departement) {
        $requete = $this->db->prepare("INSERT INTO departement VALUES (dep_nom, vil_num) VALUES (:nom, :vil_num);");
        $requete->bindValue(':nom', $departement->getDepNum());
        $requete->bindValue(':vil_num', $departement->getVilNum());

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllDepartement() {
        $listeDepartements = array();
        $sql = "SELECT dep_num, dep_nom FROM departement ORDER BY dep_num";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($departement = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeDepartements[] = new Departement($departement);
        }

        $requete->closeCursor();

        return $listeDepartements;
    }

    public function getDepNom($num) {
        $sql = "SELECT dep_nom FROM departement WHERE dep_num = :num;";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);

        $requete->execute();

        return $requete->fetch(PDO::FETCH_OBJ);
    }
}