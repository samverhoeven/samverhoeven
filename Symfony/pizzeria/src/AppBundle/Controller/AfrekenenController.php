<?php

// src/AppBundle/Controller/AfrekenenController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AfrekenenController extends Controller {

    public function afrekenenAction() {
        $productSvc = new ProductService();

        if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
            if ($_SESSION["aangemeld"]) {
                $klant = KlantService::getKlantById($_SESSION["klant"]);
            }
        }

        if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
            if ($_GET["action"] == uitloggen) {
                $_SESSION["aangemeld"] = false;
                unset($_SESSION["winkelmandje"]);
                $_SESSION["prijs"] = 0;

                header("Location: afrekenen.php");
                exit(0);
            }
        }

        if (isset($_GET["verwijder"])) { //checkt of er een item uit winkelmandje moet verwijderd worden
            $verwijder = $_GET["verwijder"];
            $verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); /* id van product dmv key uit de array winkelmandje */
            if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
                $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPromotie();
            } else {
                $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPrijs();
            }
            unset($_SESSION["winkelmandje"][$verwijder]);

            header("Location: afrekenen.php");
            exit(0);
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
            header("Location: afrekenen.php?bestelcheck=true");
        }

        if (isset($_GET["bestelcheck"])) { //checkt of bestelling is geplaatst om overzicht te tonen
            $bestelcheck = true;
            unset($_SESSION["winkelmandje"]);
            $_SESSION["prijs"] = 0;
            $producten = ProductService::getAllProducts();
            $bestelling = BestellingService::getBestelling($_SESSION["klant"]);
            $bestregels = BestregService::getBestreg($bestelling->getId());
        }
    }

}
