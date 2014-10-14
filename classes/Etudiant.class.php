<?php
class Etudiant {
    private $per_num;

    public function getPerNum() {
        return $this->per_num;
    }

    public function setPerNum($per_num) {
        $this->per_num = $per_num;

        return $this;
    }
}