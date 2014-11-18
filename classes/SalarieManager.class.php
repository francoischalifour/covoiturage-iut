<?php
class SalarieManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ajout

    public function getAllSalarie() {
        $listeSalaries = array();
        $sql = "SELECT per_num, sal_telprof, fon_num FROM salarie";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($salarie = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeSalaries[] = new Salarie($salarie);
        }

        $requete->closeCursor();

        return $listeSalaries;
    }

    public function isSalarie($numero) {
        $requete = $this->db->prepare("SELECT COUNT(*) per_num FROM salarie WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM)[0];

        // Retourne 0 si pas salarié
        return $resultat;
    }
}