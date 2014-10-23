<?php
class SalarieManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllSalarie() {
        $listeSalaries = array();
        $sql = "SELECT per_num, sal_telprof, fon_num FROM salarie";
        $requete = $this->db->prepare($sql);
        $requete->execute;

        while ($salarie = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeSalaries[] = new Salarie($salarie);
        }

        $requete->closeCursor();

        return $listeSalaries;
    }
}