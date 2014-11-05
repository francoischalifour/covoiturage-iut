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

        $retour = $requete->execute();

        return $retour;
    }

    public function getAllpersonne() {
        $listePersonnes = array();
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                    FROM personne ORDER BY per_nom";
        $requete = $this->db->prepare($sql);
        $requete->execute;

        while ($personne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listePersonnes[] = new Personne($personne);
        }

        $requete->closeCursor();

        return $listePersonnes;
    }
}