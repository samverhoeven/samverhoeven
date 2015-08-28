<?php
class Spelbord {

    private $bord;
    
    private function genereerStartOpstelling() {
        for($i=0; $i<1; $i++) {
            $kolom = rand(0, $this->getAantalKolommen() - 1);
            $rij = rand(0, $this->getAantalRijen() - 1);
            $this->schakelOm($kolom, $rij);
        }
    }

    public function __construct($kolommen, $rijen) {
        $this->bord = array();
        for ($c = 0; $c < $kolommen; $c++) {
            $this->bord[$c] = array();
            for ($r = 0; $r < $rijen; $r++) {
                $this->bord[$c][$r] = 0;
            }
        }
        $this->genereerStartOpstelling();
    }

    public function getAantalKolommen() {
        return count($this->bord);
    }

    public function getAantalRijen() {
        return count($this->bord[0]);
    }

    public function getStatus($kolom, $rij) {
        return $this->bord[$kolom][$rij];
    }

    private function schakelSpecifiek($kolom, $rij) {
        if ($this->bord[$kolom][$rij] == 0) {
            $this->bord[$kolom][$rij] = 1;
        } else {
            $this->bord[$kolom][$rij] = 0;
        }
    }
    
    private function alleLichtenZijnUit() {
        $lichtGevonden = false;
        $kolom = 0;
        while ($lichtGevonden == false && $kolom < $this->getAantalKolommen()) {
            $rij = 0;
            while ($lichtGevonden == false && $rij < $this->getAantalRijen()) {
                if ($this->getStatus($kolom, $rij) == 1) {
                    $lichtGevonden = true;
                }
                $rij++;
            }
            $kolom++;
        }
        return !$lichtGevonden;
    }

    public function schakelOm($kolom, $rij) {
        $this->schakelSpecifiek($kolom, $rij);
        if ($kolom > 0) {
            $this->schakelSpecifiek($kolom - 1, $rij);
        }
        if ($kolom < $this->getAantalKolommen() - 1) {
            $this->schakelSpecifiek($kolom + 1, $rij);
        }
        if ($rij > 0) {
            $this->schakelSpecifiek($kolom, $rij - 1);
        }
        if ($rij < $this->getAantalRijen() - 1) {
            $this->schakelSpecifiek($kolom, $rij + 1);
        }
        return $this->alleLichtenZijnUit();
    }
    

}