<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Klant
 *
 * @ORM\Table(name="klanten")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KlantRepository")
 */
class Klant extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=20)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="voornaam", type="string", length=30)
     */
    private $voornaam;

    /**
     * @var string
     *
     * @ORM\Column(name="straat", type="string", length=50)
     */
    private $straat;

    /**
     * @var int
     *
     * @ORM\Column(name="huisnummer", type="integer")
     */
    private $huisnummer;

    /**
     * @var int
     *
     * @ORM\Column(name="postcode", type="integer")
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="woonplaats", type="string", length=40)
     */
    private $woonplaats;

    /**
     * @var int
     *
     * @ORM\Column(name="telefoon", type="string", length=20)
     */
    private $telefoon;

    /**
     * @var string
     *
     * @ORM\Column(name="bemerking", type="text", nullable=true)
     */
    private $bemerking;

    /**
     * @var int
     *
     * @ORM\Column(name="promotie", type="integer", options={"default":0}, nullable=true)
     */
    private $promotie = 0;
    
    public function __construct() {
        parent::__construct();
        $this->roles = array('ROLE_USER'); //ROLE_USER wordt als default waarde aan klant gegeven
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set naam
     *
     * @param string $naam
     *
     * @return Klant
     */
    public function setNaam($naam) {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam() {
        return $this->naam;
    }

    /**
     * Set voornaam
     *
     * @param string $voornaam
     *
     * @return Klant
     */
    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;

        return $this;
    }

    /**
     * Get voornaam
     *
     * @return string
     */
    public function getVoornaam() {
        return $this->voornaam;
    }

    /**
     * Set straat
     *
     * @param string $straat
     *
     * @return Klant
     */
    public function setStraat($straat) {
        $this->straat = $straat;

        return $this;
    }

    /**
     * Get straat
     *
     * @return string
     */
    public function getStraat() {
        return $this->straat;
    }

    /**
     * Set huisnummer
     *
     * @param integer $huisnummer
     *
     * @return Klant
     */
    public function setHuisnummer($huisnummer) {
        $this->huisnummer = $huisnummer;

        return $this;
    }

    /**
     * Get huisnummer
     *
     * @return int
     */
    public function getHuisnummer() {
        return $this->huisnummer;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     *
     * @return Klant
     */
    public function setPostcode($postcode) {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return int
     */
    public function getPostcode() {
        return $this->postcode;
    }

    /**
     * Set woonplaats
     *
     * @param string $woonplaats
     *
     * @return Klant
     */
    public function setWoonplaats($woonplaats) {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * Get woonplaats
     *
     * @return string
     */
    public function getWoonplaats() {
        return $this->woonplaats;
    }

    /**
     * Set telefoon
     *
     * @param integer $telefoon
     *
     * @return Klant
     */
    public function setTelefoon($telefoon) {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return int
     */
    public function getTelefoon() {
        return $this->telefoon;
    }

    /**
     * Set bemerking
     *
     * @param string $bemerking
     *
     * @return Klant
     */
    public function setBemerking($bemerking) {
        $this->bemerking = $bemerking;

        return $this;
    }

    /**
     * Get bemerking
     *
     * @return string
     */
    public function getBemerking() {
        return $this->bemerking;
    }

    /**
     * Set promotie
     *
     * @param integer $promotie
     *
     * @return Klant
     */
    public function setPromotie($promotie) {
        $this->promotie = $promotie;

        return $this;
    }

    /**
     * Get promotie
     *
     * @return int
     */
    public function getPromotie() {
        return $this->promotie;
    }

}
