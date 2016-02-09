<?php

// src/AppBundle/Controller/MenutonenController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller {

    /**
     * @route(
     *      path = "/menu",
     *      name = "menu_show"
     * ) 
     */
    public function showAction(Request $request) {
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

        if ($this->getUser()) {//checkt of er een klant is aangemeld
                $klant = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->find($this->getUser()->getId());
        }

        if ($request->query->get("product")) {
            try {
                $productId = $request->query->get("product");
                $product = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Product")
                        ->find($productId); /* zet de gekozen producten in een array winkelmandjes mbv een session variabele */
              
                $winkelmandje = $session->get("winkelmandje");
                $winkelmandje[] = $product;
                $session->set("winkelmandje", $winkelmandje);
                
                if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
                    $session->set("prijs", $session->get("prijs") + $product->getPromotie());
                } else {
                    $session->set("prijs", $session->get("prijs") + $product->getPrijs());
                }
                return $this->redirect($this->generateUrl('menu_show')); /* opnieuw uitvoeren van bovenstaande code bij verversen tegen te gaan */
            } catch (PDOException $dbe) {
                $databaseError = "Menu is momenteel niet beschikbaar.";
            }
        }

        if ($request->query->get("verwijder")) { //checkt of er een item uit winkelmandje moet verwijderd worden
            $verwijder = $request->query->get("verwijder");
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
            
            return $this->redirect($this->generateUrl('menu_show'));
        }

        if (empty($session->get("winkelmandje"))) { // Zorgt voor niet tonen van winkelmandje als dat leeg is
            $leeg = true;
        } else {
            $leeg = false;
        }

        /* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */
        if (!isset($klant)) {
            $klant = null;
        }

        if (!$session->has("winkelmandje")) {
            $session->set("winkelmandje", []);
        }
        
        if (!$session->has("aangemeld")) {
            $session->set("aangemeld",false);
        }

        if (!$session->has("prijs")) {
            $session->set("prijs", 0);
        }
        
        return $this->render("Pizzeria/menu.html.twig", array("menu" => $menu, "winkelmandje" => $session->get("winkelmandje"),
                    "totaalprijs" => $session->get("prijs"), "leeg" => $leeg, "aangemeld" => $session->get("aangemeld"), "klant" => $klant, "databaseError" => $databaseError));
    }

}
