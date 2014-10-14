<?php
class Salarie {
    private $sal_telprof;

    public function getSalTelprof() {
        return $this->sal_telprof;
    }

    public function setSalTelprof($sal_telprof) {
        $this->sal_telprof = $sal_telprof;

        return $this;
    }
}