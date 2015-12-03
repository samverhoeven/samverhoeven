<?php

namespace BroodjesProject\Entities;

class Bestelregel {

    private static $idMap = array();
    private $id;
    private $bestelId;
    private $broodjeId;
    private $regelprijs;
    private $tijdstip;

    function __construct($id, $bestelId, $broodjeId, $regelprijs, $tijdstip) {
        $this->id = $id;
        $this->bestelId = $bestelId;
        $this->broodjeId = $broodjeId;
        $this->regelprijs = $regelprijs;
        $this->tijdstip = $tijdstip;
    }

    public static function create($id, $bestelId, $broodjeId, $regelprijs, $tijdstip) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Bestelregel($id, $bestelId, $broodjeId, $regelprijs, $tijdstip);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getBestelId() {
        return $this->bestelId;
    }

    function getBroodjeId() {
        return $this->broodjeId;
    }

    function getRegelprijs() {
        return $this->regelprijs;
    }

    function getTijdstip() {
        return $this->tijdstip;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBestelId($bestelId) {
        $this->bestelId = $bestelId;
    }

    function setBroodjeId($broodjeId) {
        $this->broodjeId = $broodjeId;
    }

    function setRegelprijs($regelprijs) {
        $this->regelprijs = $regelprijs;
    }

    function setTijdstip($tijdstip) {
        $this->tijdstip = $tijdstip;
    }

}
