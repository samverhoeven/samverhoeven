<?php

namespace BroodjesProject\Entities;

class Customer {

    private static $idMap = array();
    private $id;
    private $email;
    private $wachtwoord;

    public static function create($id, $email, $wachtwoord) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Customer($id, $email, $wachtwoord);
        }
        return self::$idMap[$id];
    }

    public function __construct($id, $email, $wachtwoord) {
        $this->id = $id;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getWachtwoord() {
        return $this->wachtwoord;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

}
