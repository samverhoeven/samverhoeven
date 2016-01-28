<?php

// src/AppBundle/Entity/Klant.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="klanten")
 */
class Klant {

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
     * @ORM\Column(type="text")
     */
    protected $voornaam;

    /**
     * @ORM\Column(type="text")
     */
    protected $straat;

    /**
     * @ORM\Column(type="integer")
     */
    protected $huisnummer;

    /**
     * @ORM\Column(type="integer")
     */
    protected $postcode;

    /**
     * @ORM\Column(type="text")
     */
    protected $woonplaats;

    /**
     * @ORM\Column(type="integer")
     */
    protected $telefoon;

    /**
     * @ORM\Column(type="text")
     */
    protected $email;

    /**
     * @ORM\Column(type="text")
     */
    protected $wachtwoord;

    /**
     * @ORM\Column(type="text")
     */
    protected $bemerking;

    /**
     * @ORM\Column(type="integer")
     */
    protected $promotie;

    function __construct($id, $naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord, $bemerking, $promotie) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->huisnummer = $huisnummer;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->telefoon = $telefoon;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->bemerking = $bemerking;
        $this->promotie = $promotie;
    }

    function getId() {
        return $this->id;
    }

    function getNaam() {
        return $this->naam;
    }

    function getVoornaam() {
        return $this->voornaam;
    }

    function getStraat() {
        return $this->straat;
    }

    function getHuisnummer() {
        return $this->huisnummer;
    }

    function getPostcode() {
        return $this->postcode;
    }

    function getWoonplaats() {
        return $this->woonplaats;
    }

    function getTelefoon() {
        return $this->telefoon;
    }

    function getEmail() {
        return $this->email;
    }

    function getWachtwoord() {
        return $this->wachtwoord;
    }

    function getBemerking() {
        return $this->bemerking;
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

    function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    function setStraat($straat) {
        $this->straat = $straat;
    }

    function setHuisnummer($huisnummer) {
        $this->huisnummer = $huisnummer;
    }

    function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    function setWoonplaats($woonplaats) {
        $this->woonplaats = $woonplaats;
    }

    function setTelefoon($telefoon) {
        $this->telefoon = $telefoon;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

    function setBemerking($bemerking) {
        $this->bemerking = $bemerking;
    }

    function setPromotie($promotie) {
        $this->promotie = $promotie;
    }
}
