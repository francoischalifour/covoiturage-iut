<?php
class EtudiantManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($etudiant) {
        $requete = $this->db->prepare("INSERT INTO etudiant
            (per_num, dep_num, div_num)
            VALUES (:per_num, :dep_num, :div_num);");

        $requete->bindValue(':per_num', $etudiant->getPerNum());
        $requete->bindValue(':dep_num', $etudiant->getDepNum());
        $requete->bindValue(':div_num', $etudiant->getDivNum());

        $requete->execute();

        return $this->db->lastInsertId();
    }

    public function getEtudiant($numero) {
        $sql = "SELECT per_num, dep_num, div_num
                    FROM etudiant WHERE per_num = $numero";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $etudiant = $requete->fetch(PDO::FETCH_ASSOC);
        $monEtudiant = new Etudiant($etudiant);

        return $monEtudiant;
    }

    public function getAllEtudiant() {
        $listeEtudiants = array();
        $sql = "SELECT per_num, dep_num, div_num FROM etudiant";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeEtudiants[] = new Salarie($etudiant);
        }

        $requete->closeCursor();

        return $listeEtudiants;
    }

    public function isEtudiant($numero) {
        $requete = $this->db->prepare("SELECT COUNT(*) per_num FROM etudiant WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM)[0];

        // Retourne 0 si pas étudiant
        return $resultat;
    }
}