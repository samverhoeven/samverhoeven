<?php
namespace BroodjesProject\Business;
use BroodjesProject\Data\BroodjeDAO;

class BroodjeService{
    public function haalBroodjesOverzicht(){
        $broodjeDAO = new BroodjeDAO();
        $lijst = $broodjeDAO->getAll();
        return $lijst;
    }
    public function haalBroodjeOp($id){
        $broodjeDAO = new BroodjeDAO();
        $broodje = $broodjeDAO->getById($id);
        return $broodje;
    }
}

