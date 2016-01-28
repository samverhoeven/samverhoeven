<?php

// src/AppBundle/Entity/Bestelregel.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bestreg")
 */
class Bestelregel{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $bestelId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $productId;
    /**
     * @ORM\Column(type="double")
     */
    protected $prijs;

    function __construct($id, $bestelId, $productId, $prijs) {
        $this->id = $id;
        $this->bestelId = $bestelId;
        $this->productId = $productId;
        $this->prijs = $prijs;
    }

    function getId() {
        return $this->id;
    }

    function getBestelId() {
        return $this->bestelId;
    }

    function getProductId() {
        return $this->productId;
    }

    function getPrijs() {
        return $this->prijs;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBestelId($bestelId) {
        $this->bestelId = $bestelId;
    }

    function setProductId($productId) {
        $this->broodjeId = $productId;
    }

    function setPrijs($prijs) {
        $this->regelprijs = $prijs;
    }
}
