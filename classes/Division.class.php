<?php
class Division {
    private $div_nom;
    private $div_num;

    public function getDivNom() {
        return $this->div_nom;
    }

    public function setDivNom($div_nom) {
        $this->div_nom = $div_nom;

        return $this;
    }

    public function getDivNum() {
        return $this->div_num;
    }

    public function setDivNum($div_num) {
        $this->div_num = $div_num;

        return $this;
    }
}