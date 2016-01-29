<?php

// src/AppBundle/Controller/AfrekenenController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class AfrekenenController extends Controller {

    /**
     * @route(
     *      path = "/afrekenen",
     *      name = "afrekenen_show"
     * ) 
     */
    public function afrekenenAction() {
        $session = new Session();

        if ($session->has("klant")) {//checkt of er een klant is aangemeld
            if ($session->get("klant")) {
                //$klant = KlantService::getKlantById($_SESSION["klant"]);
                $klant = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->find($session->get("klant"));
            }
        }

        /*if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
            if ($_GET["action"] == "uitloggen") {
                $_SESSION["aangemeld"] = false;
                unset($_SESSION["winkelmandje"]);
                $_SESSION["prijs"] = 0;

                return $this->redirect($this->generateUrl('afrekenen_show'));
            }
        }*/

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

            return $this->redirect($this->generateUrl('afrekenen_show'));
        }

        if (isset($_GET["besteld"])) { //bestellingsgegevens in juiste tabellen zetten
            
            $bestellingId = BestellingService::createBestelling($_SESSION["klant"], $_SESSION["prijs"], date("Y-m-d - H:i:sa"));
            foreach ($_SESSION["winkelmandje"] as $product) {
                if ($klant->getPromotie() == 1) { //checkt of promotieprijs of gewone prijs aan bestreg moet meegegeven worden
                    BestregService::createBestreg($bestellingId, $product->getId(), $product->getPromotie());
                } else {
                    BestregService::createBestreg($bestellingId, $product->getId(), $product->getPrijs());
                }
            }
            return $this->redirect($this->generateUrl('afrekenen_show', array("bestelcheck" => "true")));
            //header("Location: afrekenen.php?bestelcheck=true");
        }

        if (isset($_GET["bestelcheck"])) { //checkt of bestelling is geplaatst om overzicht te tonen
            $bestelcheck = true;
            unset($_SESSION["winkelmandje"]);
            $_SESSION["prijs"] = 0;
            $producten = ProductService::getAllProducts();
            $bestelling = BestellingService::getBestelling($_SESSION["klant"]);
            $bestregels = BestregService::getBestreg($bestelling->getId());
        }

        /* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */

        if (!isset($klant)) {
            $klant = null;
        }

        if (!isset($bestelling)) {
            $bestelling = null;
        }

        if (!isset($bestregels)) {
            $bestregels = null;
        }

        if (!isset($producten)) {
            $producten = null;
        }

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld",false);
        }

        if (!isset($bestelcheck)) {
            $bestelcheck = false;
        }

        if (!$session->has("winkelmandje")) {
            $session->set("winkelmandje",[]);
        }

        return $this->render("Pizzeria/afrekening.html.twig", array("winkelmandje" => $session->get("winkelmandje"),
                    "totaalprijs" => $session->get("prijs"), "aangemeld" => $session->get("aangemeld"),
                    "bestelcheck" => $bestelcheck, "bestelling" => $bestelling, "bestregels" => $bestregels,
                    "producten" => $producten, "klant" => $klant));
    }

}
