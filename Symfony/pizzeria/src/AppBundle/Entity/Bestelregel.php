<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelregel
 *
 * @ORM\Table(name="bestreg")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestelregelRepository")
 */
class Bestelregel
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
     * @var int
     *
     * @ORM\Column(name="bestelid", type="integer")
     */
    private $bestelid;

    /**
     * @var int
     *
     * @ORM\Column(name="productid", type="integer")
     */
    private $productid;

    /**
     * @var float
     *
     * @ORM\Column(name="prijs", type="float")
     */
    private $prijs;


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
     * Set bestelid
     *
     * @param integer $bestelid
     *
     * @return Bestelregel
     */
    public function setBestelid($bestelid)
    {
        $this->bestelid = $bestelid;

        return $this;
    }

    /**
     * Get bestelid
     *
     * @return int
     */
    public function getBestelid()
    {
        return $this->bestelid;
    }

    /**
     * Set productid
     *
     * @param integer $productid
     *
     * @return Bestelregel
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;

        return $this;
    }

    /**
     * Get productid
     *
     * @return int
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * Set prijs
     *
     * @param float $prijs
     *
     * @return Bestelregel
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
}

