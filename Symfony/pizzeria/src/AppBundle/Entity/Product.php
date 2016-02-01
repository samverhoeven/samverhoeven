<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="producten")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="text")
     */
    private $naam;

    /**
     * @var float
     *
     * @ORM\Column(name="prijs", type="float")
     */
    private $prijs;

    /**
     * @var string
     *
     * @ORM\Column(name="samenstelling", type="text")
     */
    private $samenstelling;

    /**
     * @var int
     *
     * @ORM\Column(name="beschikbaarheid", type="integer")
     */
    private $beschikbaarheid;

    /**
     * @var float
     *
     * @ORM\Column(name="promotie", type="float")
     */
    private $promotie;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set naam
     *
     * @param string $naam
     *
     * @return Product
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set prijs
     *
     * @param float $prijs
     *
     * @return Product
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return float
     */
    public function getPrijs()
    {
        return $this->prijs;
    }

    /**
     * Set samenstelling
     *
     * @param string $samenstelling
     *
     * @return Product
     */
    public function setSamenstelling($samenstelling)
    {
        $this->samenstelling = $samenstelling;

        return $this;
    }

    /**
     * Get samenstelling
     *
     * @return string
     */
    public function getSamenstelling()
    {
        return $this->samenstelling;
    }

    /**
     * Set beschikbaarheid
     *
     * @param integer $beschikbaarheid
     *
     * @return Product
     */
    public function setBeschikbaarheid($beschikbaarheid)
    {
        $this->beschikbaarheid = $beschikbaarheid;

        return $this;
    }

    /**
     * Get beschikbaarheid
     *
     * @return int
     */
    public function getBeschikbaarheid()
    {
        return $this->beschikbaarheid;
    }

    /**
     * Set promotie
     *
     * @param float $promotie
     *
     * @return Product
     */
    public function setPromotie($promotie)
    {
        $this->promotie = $promotie;

        return $this;
    }

    /**
     * Get promotie
     *
     * @return float
     */
    public function getPromotie()
    {
        return $this->promotie;
    }
}

