<?php
class Parcours {
    private $par_num;
    private $par_km;
    private $vil_num1;
    private $vil_num2;

    public function __construct($valeurs = array()) {
        $this->affecte($valeurs);
    }

    public function affecte($donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'par_num':
                    $this->setParNum($valeur);
                    break;

                case 'par_km':
                    $this->setParKM($valeur);
                    break;

                case 'vil_num1':
                    $this->setParVilNum1($valeur);
                    break;

                case 'vil_num2':
                    $this->setParVilNum2($valeur);
                    break;
            }
        }
    }

    public function getParNum() {
        return $this->par_num;
    }

    public function setParNum($par_num) {
        $this->par_num = $par_num;

        return $this;
    }

    public function getParKm() {
        return $this->par_km;
    }

    public function setParKm($par_km) {
        $this->par_km = $par_km;

        return $this;
    }

    public function getVilNum1() {
        return $this->vil_num1;
    }

    public function setVilNum1($vil_num1) {
        $this->vil_num1 = $vil_num1;

        return $this;
    }

    public function getVilNum2() {
        return $this->vil_num2;
    }

    public function setVilNum2($vil_num2) {
        $this->vil_num2 = $vil_num2;

        return $this;
    }
}