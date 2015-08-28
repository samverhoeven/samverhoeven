<?php

namespace BroodjesProject\Business;

use BroodjesProject\Data\CustomerDAO;

class CustomerService {

    public function controleerKlant($email, $wachtwoord) {
        $customer = CustomerDAO::getByEmail($email);
        if (isset($customer) && $customer->getWachtwoord() == $wachtwoord) {
            return true;
        } else {
            return false;
        }
    }

    public function controleerGeregistreerd($email, $wachtwoord) {
        $customer = CustomerDAO::getByEmail($email);
        if (isset($customer)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getKlantId($email){
        $customer = CustomerDAO::getByEmail($email);
        return $customer->getId();
    }
    
    public function haalKlantOp($id){
        $customer = CustomerDAO::getById($id);
        return $customer;
    }

    public function voegNieuweklantToe($voornaam, $achternaam, $email, $wachtwoord) {
        CustomerDAO::create($voornaam, $achternaam, $email, $wachtwoord);
    }
    
    public function wijzigWachtwoord($id, $wachtwoord){
        CustomerDAO::changePassword($id, $wachtwoord);
    }

}
