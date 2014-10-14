<?php
class Propose{
	private $pro_date;
	private $pro_time;
	private $pro_place;
	private $pro_sens;

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
}