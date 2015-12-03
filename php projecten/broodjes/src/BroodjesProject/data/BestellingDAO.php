<?php

namespace BroodjesProject\Data;

use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\Bestelling;

class BestellingDAO {

    public function getByKlantId($klantId) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, klantid, bestellingsprijs, datum from bestellingen where klantid = '" . $klantId . "' order by datum desc limit 1";
        $resultSet = $dbh->query($sql);

        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $bestelling = Bestelling::create($rij["id"], $rij["klantid"], $rij["bestellingsprijs"], $rij["datum"]);
                $dbh = null;
                return $bestelling;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function create($klantId, $bestellingsprijs, $datum) {
        $sql = "insert into bestellingen (klantid, bestellingsprijs, datum) "
                . "values ('" . $klantId . "','" . $bestellingsprijs . "','".$datum."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function update($klantId, $bestellingsprijs){
        $sql= "update bestellingen set bestellingsprijs = bestellingsprijs + '".$bestellingsprijs."' where klantid= '".$klantId."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
