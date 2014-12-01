<?php
class ParcoursManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($parcours) {
        $par1 = $this->getParcoursByVilNums($parcours->getVilNum1(), $parcours->getVilNum2());
        $par2 = $this->getParcoursByVilNums($parcours->getVilNum2(), $parcours->getVilNum1());

        // Si le parcours existe déjà
        if ($par1 != null || $par2 != null)
            return false;

        $requete = $this->db->prepare("INSERT INTO parcours (par_num, par_km, vil_num1, vil_num2) VALUES (:par_num, :par_km, :vil_num1, :vil_num2);");
        $requete->bindValue(':par_num', $parcours->getParNum());
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

    public function getParcours($numero) {
        $requete = $this->db->prepare("SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours WHERE par_num=:par_num");
        $requete->bindValue(':par_num', $numero);

        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getParcoursByVilNums($vil_num1, $vil_num2) {
        $requete = $this->db->prepare("SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours WHERE vil_num1 = :vil_num1 AND vil_num2 = :vil_num2");
        $requete->bindValue(':vil_num1', $vil_num1);
        $requete->bindValue(':vil_num2', $vil_num2);

        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat != null)
            return new Parcours($resultat);
        else
            return null;
    }

    public function getVilNumInParcours($vil_num) {
        $listeVilles = array();
        $villeManager = new VilleManager($this->db);
        $requete = "SELECT vil_num1 AS vil_num FROM parcours WHERE vil_num2 = :vil_num
                                UNION
                                SELECT vil_num2 FROM parcours WHERE vil_num1 = :vil_num";
        $requete = $this->db->prepare($requete);
        $requete->bindValue(":vil_num", $vil_num);

        $requete->execute();

        while($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeVilles[] = $villeManager->getVilNom($ligne["vil_num"]);
        }

        return $listeVilles;
    }
}