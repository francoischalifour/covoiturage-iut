<?php
class Ville {
    private $vil_num;
    private $vil_nom;

    public function getVilNum() {
        return $this->vil_num;
    }

    public function setVilNum($vil_num) {
        $this->vil_num = $vil_num;
    }

    public function getVilNom() {
        return $this->vil_nom;
    }

    public function setVilNom($vil_nom) {
        $this->vil_nom = $vil_nom;
        return $this;
    }
}