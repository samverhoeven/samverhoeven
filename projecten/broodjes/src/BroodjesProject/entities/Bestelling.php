<?php

namespace BroodjesProject\Entities;

class Bestelling {

    private static $idMap = array();
    private $id;
    private $klantId;
    private $bestellingsprijs;
    private $datum;

    function __construct($id, $klantId, $bestellingsprijs, $datum) {
        $this->id = $id;
        $this->klantId = $klantId;
        $this->bestellingsprijs = $bestellingsprijs;
        $this->datum = $datum;
    }

    public static function create($id, $klantId, $bestellingsprijs, $datum) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Bestelling($id, $klantId, $bestellingsprijs, $datum);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getKlantId() {
        return $this->klantId;
    }

    function getBestellingsprijs() {
        return $this->bestellingsprijs;
    }

    function getDatum() {
        return $this->datum;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setKlantId($klantId) {
        $this->klantId = $klantId;
    }

    function setBestellingsprijs($bestellingsprijs) {
        $this->bestellingsprijs = $bestellingsprijs;
    }

    function setDatum($datum) {
        $this->datum = $datum;
    }

}
