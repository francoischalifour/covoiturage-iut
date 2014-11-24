<?php
class PersonneManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($personne) {
        $requete = $this->db->prepare("INSERT INTO personne
            (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
            VALUES (:nom, :prenom, :tel, :mail, :login, :pwd);");

        $requete->bindValue(':nom', $personne->getPerNom());
        $requete->bindValue(':prenom', $personne->getPerPrenom());
        $requete->bindValue(':tel', $personne->getPerTel());
        $requete->bindValue(':mail', $personne->getPerMail());
        $requete->bindValue(':login', $personne->getPerLogin());
        $requete->bindValue(':pwd', $personne->getPerPwd());

        $requete->execute();

        return $this->db->lastInsertId();
    }

    public function getAllpersonne() {
        $listePersonnes = array();
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                    FROM personne ORDER BY per_nom";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($personne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listePersonnes[] = new Personne($personne);
        }

        $requete->closeCursor();

        return $listePersonnes;
    }

    public function getPersonne($numero) {
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                    FROM personne WHERE per_num = $numero";
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $personne = $requete->fetch(PDO::FETCH_ASSOC);
        $maPersonne = new Personne($personne);

        return $maPersonne;
    }

    public function isPersonne($numero) {
        $requete = $this->db->prepare("SELECT COUNT(*) per_num FROM personne WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM)[0];

        // Retourne 0 si pas personne
        return $resultat;
    }

    public function isEmpty() {
        $requete = $this->db->prepare("SELECT COUNT(*) per_num FROM personne");
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_NUM)[0];

        if ($resultat == 0) {
            return true;
        } else {
            return false;
        }
    }
}