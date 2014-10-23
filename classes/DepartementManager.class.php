<?php
class DepartementManager{
	private $db;

    public function __construct($db) {
    	$this->db = $db;
	}

    public function add($departement) {
	    $requete = $this->db->prepare("INSERT INTO departement VALUES (dep_nom) VALUES (:nom);");
	    $requete->bindValue(':nom', $departement->getDepNum());

	    $retour = $requete->execute();

	    return $retour;
	}

	public function getAlldepartement() {
	    $listeDepartements = array();
	    $sql = "SELECT dep_num, dep_nom FROM departement ORDER BY dep_num";
	    $requete = $this->db->prepare($sql);
	    $requete->execute;

	    while ($departement = $requete->fetch(PDO::FETCH_ASSOC)) {
	        $listDepartements[] = new Departement($departement);
	    }

	    $requete->closeCursor();

	    return $listeDepartements;
	}
	
}