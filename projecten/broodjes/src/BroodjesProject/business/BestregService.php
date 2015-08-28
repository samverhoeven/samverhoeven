<?php

namespace BroodjesProject\Business;

use BroodjesProject\Data\BestregDAO;

class BestregService{
    
    public function haalBestregOp($bestellingId){
        $bestelling = BestregDAO::getByBestellingId($bestellingId);
        return $bestelling;
    }
    
    public function voegBestregToe($bestellingId, $broodjeId, $regelprijs, $tijdstip){
        $bestregId = BestregDAO::create($bestellingId, $broodjeId, $regelprijs, $tijdstip);
        return $bestregId;
    }
}

