<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelling
 *
 * @ORM\Table(name="bestellingen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestellingRepository")
 */
class Bestelling
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
     * @ORM\Column(name="klantid", type="integer")
     */
    private $klantid;

    /**
     * @var float
     *
     * @ORM\Column(name="prijs", type="float")
     */
    private $prijs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime")
     */
    private $datum;


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
     * Set klantid
     *
     * @param integer $klantid
     *
     * @return Bestelling
     */
    public function setKlantid($klantid)
    {
        $this->klantid = $klantid;

        return $this;
    }

    /**
     * Get klantid
     *
     * @return int
     */
    public function getKlantid()
    {
        return $this->klantid;
    }

    /**
     * Set prijs
     *
     * @param float $prijs
     *
     * @return Bestelling
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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Bestelling
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }
}

