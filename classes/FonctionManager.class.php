<?php
class FonctionManager{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($fonction) {
        $requete = $this->db->prepare("INSERT INTO fonction VALUES (fon_libelle) VALUES (:libelle);");
        $requete->bindValue(':libelle', $fonction->getFonNum());

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllFonction() {
        $listefonctions = array();
        $sql = "SELECT fon_num, fon_libelle FROM fonction";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($fonction = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listefonctions[] = new Fonction($fonction);
        }

        $requete->closeCursor();

        return $listefonctions;
    }

}