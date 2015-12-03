<?php

namespace BroodjesProject\Data;

use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\Bestelregel;

class BestregDAO {

    public function getByBestellingId($bestellingId) {
        $lijst = array();
        $sql = "select * from bestreg where bestellingid = '" . $bestellingId . "' "
                . "and date(tijdstip) = '" . date("Y-m-d") . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $lijst[] = Bestelregel::create($rij["id"], $rij["bestellingid"], $rij["broodjeid"], 
                        $rij["regelprijs"], $rij["tijdstip"]);
            }
            $dbh = null;
            return $lijst;
        } else {
            return null;
        }
    }

    public function create($bestellingId, $broodjeId, $regelprijs, $tijdstip) {
        $sql = "insert into bestreg (bestellingid, broodjeid, regelprijs, tijdstip) "
                . "values('" . $bestellingId . "','" . $broodjeId . "','" . $regelprijs . "','" . $tijdstip . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $bestregId = $dbh->lastInsertId();
        $dbh = null;
        return $bestregId;
    }

}
