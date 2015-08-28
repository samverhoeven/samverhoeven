<?php

namespace BroodjesProject\Data;

use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\Customer;

class CustomerDAO {

    public static function getByEmail($email) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, email, wachtwoord from klanten where email = '" . $email . "'";
        $resultSet = $dbh->query($sql);

        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $customer = Customer::create($rij["id"], $rij["email"], $rij["wachtwoord"]);
                $dbh = null;
                return $customer;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getById($id) {
        $sql = "select id, email, wachtwoord from klanten where id = '" . $id . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $customer = Customer::create($rij["id"], $rij["email"], $rij["wachtwoord"]);
                $dbh = null;
                return $customer;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function create($voornaam, $achternaam, $email, $wachtwoord) {
        $sql = "insert into klanten (voornaam, achternaam, email, wachtwoord) "
                . "values ('" . $voornaam . "','" . $achternaam . "','" . $email . "','" . $wachtwoord . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public function changePassword($id, $wachtwoord) {
        $sql = "update klanten set wachtwoord = '" . $wachtwoord . "' where id = '" . $id . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

}
