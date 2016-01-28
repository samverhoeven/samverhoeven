<?php

// src/AppBundle/Controller/LoginController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller {
    
    /**
     * @route(
     *      path = "/login",
     *      name = "login_show"
     * ) 
     */
    public function showAction() {
        $databaseError = null;
        
        if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
            if ($_SESSION["aangemeld"]) {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        if (isset($_GET["bestellen"])) {//checkt of gebruiker van bestelpagina komt
            if ($_GET["bestellen"]) {
                $_SESSION["bestellen"] = true;
            } else {
                $_SESSION["bestellen"] = false;
            }
            return $this->redirect($this->generateUrl('login_show'));
        }

        $foutegegevens = false;
        $bestaatniet = false;

        if (isset($_GET["action"])) {//checkt of er iemand wilt inloggen
            if ($_GET["action"] == "login") {
                try {
                    $email = trim($_POST["email"]);
                    $wachtwoord = sha1(trim($_POST["wachtwoord"]));
                    $resultaat = $klantSvc->controleerKlant($email, $wachtwoord);
                    if ($resultaat) {
                        $_SESSION["aangemeld"] = true;
                        $_SESSION["klant"] = $klantSvc->getKlantId($email);
                        setcookie("emailCookie", $email);
                        $klant = $klantSvc->getKlantById($_SESSION["klant"]);
                        if ($klant->getPromotie() == 1) { //als klant inlogd en winkelmandje al gevuld is, moet prijs herberekend worden
                            if (!empty($_SESSION["winkelmandje"])) {
                                $_SESSION["prijs"] = 0;
                                foreach ($_SESSION["winkelmandje"] as $keuze) {
                                    $_SESSION["prijs"] += $keuze->getPromotie();
                                }
                            }
                        }
                        if (isset($_SESSION["bestellen"])) {
                            if ($_SESSION["bestellen"]) {
                                $_SESSION["bestellen"] = false;
                                header("Location: afrekenen.php");
                                exit(0);
                            }
                        }
                        return $this->redirect($this->generateUrl('index'));
                    } else { //error handling
                        $geregistreerd = $klantSvc->controleerGeregistreerd($email);
                        if ($geregistreerd) {
                            $foutegegevens = true;
                        } else {
                            $bestaatniet = true;
                        }
                    }
                    
                } catch (PDOException $dbe) {
                    $databaseError = "Inloggen is op dit moment niet mogelijk.";
                }
            }
        }

        /* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */

        if (!isset($_SESSION["aangemeld"])) {
            $_SESSION["aangemeld"] = false;
        }

        if (!isset($_COOKIE["emailCookie"])) {
            $_COOKIE["emailCookie"] = "";
        }

        error_reporting(E_ALL & ~E_NOTICE);

        return $this->render("Pizzeria/inlogform.html.twig", array("aangemeld" => $_SESSION["aangemeld"], "email" => $_COOKIE["emailCookie"], "foutegegevens" => $foutegegevens, "bestaatniet" => $bestaatniet, "databaseError" => $databaseError));
    }

}
