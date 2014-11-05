<?php
class ParcoursManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($parcours) {
        $requete = $this->db->prepare("INSERT INTO parcours
                                                    (par_km, vil_num1, vil_num2)
                                                    VALUES (:par_km, : vil_num1, :vil_num2);");
        $requete->bindValue(':par_km', $parcours->getParKm());
        $requete->bindValue(':vil_num1', $parcours->getVilNum1());
        $requete->bindValue(':vil_num2', $parcours->getVilNum2());

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllParcours() {
        $listeParcours = array();
        $sql = "SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($parcours = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeParcours[] = new Parcours($parcours);
        }

        $requete->closeCursor();

        return $listeParcours;
    }
}