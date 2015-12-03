<?php

namespace BroodjesProject\Business;

use BroodjesProject\Data\BelegBestregDAO;

class BelegBestregService{
    public function haalBelegBestregOverzicht(){
        $lijst = BelegBestregDAO::getAll();
        return $lijst;
    }
    
    public function voegBelegBestregToe($bestregId,$belegId){
        BelegBestregDAO::create($bestregId,$belegId);
    }
}

