<?php
class Propose {
    private $par_num;
    private $per_num;
    private $pro_date;
    private $pro_time;
    private $pro_place;
    private $pro_sens;

    public function __construct($valeurs = array()) {
        if (!empty($valeurs)) {
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case "vil_num":
                    $this->setVilNum($valeur);
                    break;

                case "vil_nom":
                    $this->setVilNom($valeur);
                    break;
            }
        }
    }

    public function getProDate() {
        return $this->pro_date;
    }

    public function setProDate($pro_date) {
        $this->pro_date = $pro_date;

        return $this;
    }

    public function getProTime() {
        return $this->pro_time;
    }

    public function setProTime($pro_time) {
        $this->pro_time = $pro_time;

        return $this;
    }

    public function getProPlace() {
        return $this->pro_place;
    }

    public function setProPlace($pro_place) {
        $this->pro_place = $pro_place;

        return $this;
    }

    public function getProSens() {
        return $this->pro_sens;
    }

    public function setProSens($pro_sens) {
        $this->pro_sens = $pro_sens;

        return $this;
    }

    public function getParNum() {
        return $this->par_num;
    }

    public function setParNum($par_num) {
        $this->par_num = $par_num;

        return $this;
    }

    public function getPerNum() {
        return $this->per_num;
    }

    public function setPerNum($per_num) {
        $this->per_num = $per_num;

        return $this;
    }
}