<?php
class Departement {
    private $dep_num;
    private $dep_nom;

    public function getDepNum() {
        return $this->dep_num;
    }

    public function setDepNum($dep_num) {
        $this->dep_num = $dep_num;

        return $this;
    }

    public function getDepNom() {
        return $this->dep_nom;
    }

    public function setDepNom($dep_nom) {
        $this->dep_nom = $dep_nom;

        return $this;
    }
}