<?php
class Parcours {
    private $par_num;
    private $par_km;

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
}