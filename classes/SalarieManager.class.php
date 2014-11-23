<?php
class SalarieManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($salarie) {
        $requete = $this->db->prepare("INSERT INTO salarie
            (per_num, sal_telprof, fon_num)
            VALUES (:per_num, :sal_telprof, :fon_num);");

        $requete->bindValue(':per_num', $salarie->getPerNum());
        $requete->bindValue(':sal_telprof', $salarie->getSalTelProf());
        $requete->bindValue(':fon_num', $salarie->getFonNum());

        $requete->execute();

        return $this->db->lastInsertId();
    }

    public function getSalarie($numero) {
        $sql = "SELECT per_num, sal_telprof, fon_num
                    FROM salarie WHERE per_num = $numero";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $salarie = $requete->fetch(PDO::FETCH_ASSOC);
        $monSalarie = new Salarie($salarie);

        return $monSalarie;
    }

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

    // Fonction utile seulement si on ajoute un nouveau type de personne
    public function isSalarie($numero) {
        $requete = $this->db->prepare("SELECT COUNT(*) per_num FROM salarie WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM)[0];

        // Retourne 0 si pas salarié
        return $resultat;
    }
}