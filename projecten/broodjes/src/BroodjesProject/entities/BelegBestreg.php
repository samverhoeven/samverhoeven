<?php

namespace BroodjesProject\Entities;

class BelegBestreg {

    private static $idMap = array();
    private $id;
    private $bestregId;
    private $belegId;

    function __construct($id, $bestregId, $belegId) {
        $this->id = $id;
        $this->bestregId = $bestregId;
        $this->belegId = $belegId;
    }

    public static function create($id, $bestregID, $belegID) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new BelegBestreg($id, $bestregID, $belegID);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getBestregId() {
        return $this->bestregId;
    }

    function getBelegId() {
        return $this->belegId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBestregId($bestregId) {
        $this->bestregId = $bestregId;
    }

    function setBelegId($belegId) {
        $this->belegId = $belegId;
    }

}
