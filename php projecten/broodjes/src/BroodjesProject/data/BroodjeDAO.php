<?php
namespace BroodjesProject\Data;
use PDO;
use BroodjesProject\Data\DBConfig;
use BroodjesProject\Entities\Broodje;

class BroodjeDAO{
    public function getAll(){
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving, prijs from broodjes";
        $resultSet = $dbh->query($sql);
        foreach($resultSet as $rij){
            $lijst[] = Broodje::create($rij["id"], $rij["omschrijving"], $rij["prijs"]);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById($id){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving, prijs from broodjes where id = '". $id ."'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $broodje = Broodje::create($rij["id"], $rij["omschrijving"], $rij["prijs"]);
        $dbh = null;
        return $broodje;
    }
}

