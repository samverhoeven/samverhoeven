<?php

// src/AppBundle/Entity/Product.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="producten")
 */
class Product{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $naam;

    /**
     * @ORM\Column(type="float")
     */
    protected $prijs;

    /**
     * @ORM\Column(type="text")
     */
    protected $samenstelling;

    /**
     * @ORM\Column(type="integer")
     */
    protected $beschikbaarheid;

    /**
     * @ORM\Column(type="float")
     */
    protected $promotie;

    function __construct($id, $naam, $prijs, $samenstelling, $beschikbaarheid, $promotie) {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->samenstelling = $samenstelling;
        $this->beschikbaarheid = $beschikbaarheid;
        $this->promotie = $promotie;
    }

    function getId() {
        return $this->id;
    }

    function getNaam() {
        return $this->naam;
    }

    function getPrijs() {
        return $this->prijs;
    }

    function getSamenstelling() {
        return $this->samenstelling;
    }

    function getBeschikbaarheid() {
        return $this->beschikbaarheid;
    }

    function getPromotie() {
        return $this->promotie;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

    function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    function setSamenstelling($samenstelling) {
        $this->samenstelling = $samenstelling;
    }

    function setBeschikbaarheid($beschikbaarheid) {
        $this->beschikbaarheid = $beschikbaarheid;
    }

    function setPromotie($promotie) {
        $this->promotie = $promotie;
    }

}
