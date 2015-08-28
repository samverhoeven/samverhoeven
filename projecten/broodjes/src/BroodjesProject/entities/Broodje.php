<?php

namespace BroodjesProject\Entities;

class Broodje {

    private static $idMap = array();
    private $id;
    private $omschrijving;
    private $prijs;

    private function __construct($id, $omschrijving, $prijs) {
        $this->id = $id;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
    }

    public static function create($id, $omschrijving, $prijs) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Broodje($id, $omschrijving, $prijs);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getOmschrijving() {
        return $this->omschrijving;
    }

    function getPrijs() {
        return $this->prijs;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setOmschrijving($omschrijving) {
        $this->omschrijving = $omschrijving;
    }

    function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

}
