<?php

namespace BroodjesProject\Data;

use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\Beleg;

class BelegDAO {

    public function getAll() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving, prijs from beleg";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $lijst[] = Beleg::create($rij["id"], $rij["omschrijving"], $rij["prijs"]);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving, prijs from beleg where id ='" . $id . "'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $beleg = Beleg::create($rij["id"], $rij["omschrijving"], $rij["prijs"]);
        $dbh = null;
        return $beleg;
    }

}
