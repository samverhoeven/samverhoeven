<?php

// src/AppBundle/Controller/WinkelmanjeController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class WinkelmandjeController extends Controller {

    /**
     * @route(
     *      path = "/winkelmandje",
     *      name = "winkelmandje_show"
     * ) 
     */
    public function showAction() {
        $session = new Session();

        if ($session->has("aangemeld")) { //checkt of er een klant is aangemeld
            if ($session->get("aangemeld")) {
                $klant = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->find($session->get("klant"));
            }
        }

        if (isset($_GET["verwijder"])) { //checkt of er een item uit winkelmandje moet verwijderd worden
            $verwijder = $_GET["verwijder"];
            //$verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); // id van product dmv key uit de array winkelmandje 

            $winkelmandje = $session->get("winkelmandje");
            $verwijderId = $winkelmandje[$verwijder]->getId();

            $verwijderproduct = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Product")
                    ->find($verwijderId);
            if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
                $session->set("prijs", $session->get("prijs") - $verwijderproduct->getPromotie());
            } else {
                $session->set("prijs", $session->get("prijs") - $verwijderproduct->getPrijs());
            }

            unset($winkelmandje[$verwijder]);
            $session->set("winkelmandje", $winkelmandje);

            return $this->redirect($this->generateUrl('winkelmandje_show'));
        }

        /*if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
            if ($_GET["action"] == "uitloggen") {
                $_SESSION["aangemeld"] = false;
                unset($_SESSION["winkelmandje"]);
                $_SESSION["prijs"] = 0;

                header("Location: index.php");
                exit(0);
            }
        }*/

        if (empty($session->get("winkelmandje"))) { // Zorgt voor niet tonen van winkelmandje als dat leeg is
            $leeg = true;
        } else {
            $leeg = false;
        }

        /* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */

        if (!isset($klant)) {
            $klant = null;
        }

        if (!isset($_SESSION["winkelmandje"])) {
            $_SESSION["winkelmandje"] = null;
        }

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld",false);
        }

        error_reporting(E_ALL & ~E_NOTICE);

        return $this->render("Pizzeria/winkelmandje.html.twig", array("winkelmandje" => $session->get("winkelmandje"),
                    "totaalprijs" => $session->get("prijs"), "leeg" => $leeg, "aangemeld" => $session->get("aangemeld"), "klant" => $klant));
    }

}
