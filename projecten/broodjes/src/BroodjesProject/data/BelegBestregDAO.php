<?php

namespace BroodjesProject\Data;

use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\BelegBestreg;

class BelegBestregDAO{
    
    public function getAll(){
        $lijst = array();
        $sql = "select * from belegbestreg";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        foreach($resultSet as $rij){
            $lijst[]= BelegBestreg::create($rij["id"],$rij["bestregid"],$rij["belegid"]);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function create($bestregId,$belegId){
        $sql = "insert into belegbestreg (bestregid, belegid) values ('".$bestregId."','".$belegId."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}

