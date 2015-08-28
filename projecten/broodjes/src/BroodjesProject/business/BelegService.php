<?php

namespace BroodjesProject\Business;

use BroodjesProject\Data\BelegDAO;

class BelegService {

    public function haalBelegOverzicht() {
        $broodjeDAO = new BelegDAO();
        $lijst = $broodjeDAO->getAll();
        return $lijst;
    }
    public function haalBelegOp($id){
        $belegDAO = new BelegDAO();
        $beleg = $belegDAO->getById($id);
        return $beleg;
    }
}
