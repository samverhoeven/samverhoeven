<?php

namespace BroodjesProject\Business;

use BroodjesProject\Data\BestellingDAO;

class BestellingService{
    public function haalBestellingOp($klantId){
        $bestelling = BestellingDAO::getByKlantId($klantId);
        return $bestelling;
    }
    public function voegBestellingToe($klantId,$bestellingskost,$datum){
        BestellingDAO::create($klantId,$bestellingskost,$datum);
    }
    public function updateBestelling($klantId,$bestellingskost){
        BestellingDAO::update($klantId,$bestellingskost);
    }
}

