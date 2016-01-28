<?php
// src/AppBundle/Entity/Bestelling.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bestellingen")
 */
class Bestelling{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $klantId;
    /**
     * @ORM\Column(type="double")
     */
    private $prijs;
    /**
     * @ORM\Column(type="text")
     */
    private $datum;

    function __construct($id, $klantId, $prijs, $datum) {
        $this->id = $id;
        $this->klantId = $klantId;
        $this->prijs = $prijs;
        $this->datum = $datum;
    }

    public static function create($id, $klantId, $prijs, $datum) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Bestelling($id, $klantId, $prijs, $datum);
        }
        return self::$idMap[$id];
    }
    
    function getId() {
        return $this->id;
    }

    function getKlantId() {
        return $this->klantId;
    }

    function getPrijs() {
        return $this->prijs;
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

    function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    function setDatum($datum) {
        $this->datum = $datum;
    }
    
    public function jsonSerialize()
    {
        return [
            'Bestelling' => [
                'Id' => $this->id,
                'KlantId' => $this->klantId,
                'Prijs' => $this->prijs,
                'Datum' => $this->datum
            ]
        ];
    }
}
