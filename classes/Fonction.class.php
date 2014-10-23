<?php
class Fonction {
	private $fon_num;
	private $fon_libelle;

    public function __construct($valeurs = array()) {
        $this->affecte($valeurs);
    }

    public function getFonNum() {
        return $this->fon_num;
    }

    public function _setFonNum($fon_num) {
        $this->fon_num = $fon_num;

        return $this;
    }

    public function getFonLibelle() {
        return $this->fon_libelle;
    }
    
    public function _setFonLibelle($fon_libelle) {
        $this->fon_libelle = $fon_libelle;

        return $this;
    }
}