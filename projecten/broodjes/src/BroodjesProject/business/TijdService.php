<?php
namespace BroodjesProject\Business;

class TijdService{
    
    public static function checkTijd(){
        $begintijd = strtotime("06:00:00");
        $eindtijd = strtotime("10:00:00");
        $nu = strtotime(date('h:i:s'));
        if(($nu > $begintijd) && ($nu < $eindtijd)){
            return true;
        }else{
            return false;
        }
    }
}

