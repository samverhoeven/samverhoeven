<?php

// src/AppBundle/Controller/MenutonenController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class MenutonenController extends Controller {

    /**
     * @route(
     *      path = "/menu",
     *      name = "menu_show"
     * ) 
     */
    public function showAction() {
        $session = new Session();

        try {
            $menu = $this->get("doctrine")
                    ->getManager()
                    ->createQuery("SELECT p FROM AppBundle:Product p ORDER BY p.prijs")
                    ->execute();

            $databaseError = null;
        } catch (PDOException $dbe) {
            $databaseError = "Het menu kan niet geladen worden.";
        }

        if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
            if ($_SESSION["aangemeld"]) {
                $klant = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->find($_SESSION["klant"]);
            }
        }

        if (isset($_GET["product"])) {
            try {
                $productId = $_GET["product"];
                $product = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Product")
                        ->find($productId); /* zet de gekozen producten in een array winkelmandjes mbv een session variabele */
                $_SESSION["winkelmandje"][] = $product;
                if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
                    $session->set("prijs", $session->get("prijs") + $product->getPromotie());
                } else {
                    $session->set("prijs", $session->get("prijs") + $product->getPrijs());
                }
                return $this->redirect($this->generateUrl('menu_show')); /* opnieuw uitvoeren van bovenstaande code bij verversen tegen te gaan */
            } catch (PDOException $dbe) {
                header("Location: updateboek.php?error=dbe");
                print($dbe);
                exit(0);
            }
        }

        if (isset($_GET["verwijder"])) { //checkt of er een item uit winkelmandje moet verwijderd worden
            $verwijder = $_GET["verwijder"];
            $verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); /* id van product dmv key uit de array winkelmandje */
            $verwijderproduct = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Product")
                    ->find($verwijderId);
            if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
                $session->set("prijs", $session->get("prijs") - $verwijderproduct->getPromotie());
            } else {
                $session->set("prijs", $session->get("prijs") - $verwijderproduct->getPrijs());
            }
            unset($_SESSION["winkelmandje"][$verwijder]);

            return $this->redirect($this->generateUrl('menu_show'));
        }

        if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
            if ($_GET["action"] == uitloggen) {
                $_SESSION["aangemeld"] = false;
                unset($_SESSION["winkelmandje"]);
                $_SESSION["prijs"] = 0;

                header("Location: menutonen.php");
                exit(0);
            }
        }

        if (empty($_SESSION["winkelmandje"])) { // Zorgt voor niet tonen van winkelmandje als dat leeg is
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

        if (!isset($_SESSION["aangemeld"])) {
            $_SESSION["aangemeld"] = false;
        }

        if (!$session->has("prijs")) {
            $session->set("prijs", 0);
        }

        return $this->render("Pizzeria/menu.html.twig", array("menu" => $menu, "winkelmandje" => $_SESSION["winkelmandje"],
                    "totaalprijs" => $session->get("prijs"), "leeg" => $leeg, "aangemeld" => $_SESSION["aangemeld"], "klant" => $klant, "databaseError" => $databaseError));
    }

}
