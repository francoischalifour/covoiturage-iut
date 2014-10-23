<?php
class EtudiantManager{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEtudiant() {
        $listeEtudiants = array();
        $sql = "SELECT per_num, dep_num, div_num FROM etudiant";
        $requete = $this->db->prepare($sql);
        $requete->execute;

        while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeEtudiants[] = new Salarie($etudiant);
        }

        $requete->closeCursor();

        return $listeEtudiants;
    }
	
}