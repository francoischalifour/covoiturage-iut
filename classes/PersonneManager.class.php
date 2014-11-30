<?php
class PersonneManager {
    private $db;
    private $salt = "48@!alsd";

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
        $requete->bindValue(':pwd', sha1(sha1($personne->getPerPwd()) . $this->getSalt()));

        $requete->execute();

        return $this->db->lastInsertId();
    }

    public function getSalt() {
        return $this->salt;
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

    public function getPersonneByLogin($login) {
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                    FROM personne WHERE per_login = :per_login";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':per_login', $login);
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

    public function updatePers($personne) {
        $requete = $this->db->prepare("UPDATE  personne SET per_nom = :per_nom, per_prenom = :per_prenom, per_tel = :per_tel, per_mail = :per_mail WHERE per_num = :numero;");

        $requete->bindValue(':numero', $personne->getPerNum());
        $requete->bindValue(':per_nom', $personne->getPerNom());
        $requete->bindValue(':per_prenom', $personne->getPerPrenom());
        $requete->bindValue(':per_tel', $personne->getPerTel());
        $requete->bindValue(':per_mail', $personne->getPerMail());

        $requete->execute();

        return $personne->getPerNum();
    }

    public function deletePers($numero, $type) {
        if ($type == 1) {
            $table = 'etudiant';
        } else {
            $table = 'salarie';
        }

        $requete = $this->db->prepare("DELETE FROM propose WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();

        $requete = $this->db->prepare("DELETE FROM $table WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();

        $requete = $this->db->prepare("DELETE FROM personne WHERE per_num = :numero");
        $requete->bindValue(":numero", $numero, PDO::PARAM_INT);
        $requete->execute();
    }

    public function verifPersonne($login, $mdp) {
        $requete = $this->db->prepare("SELECT per_login FROM personne WHERE per_login = :per_login AND per_pwd = :per_pwd");

        $requete->bindValue(':per_login', $login);
        $requete->bindValue(':per_pwd', sha1(sha1($mdp) . $this->getSalt()));

        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat)
            return true;
        else
            return false;
    }
}