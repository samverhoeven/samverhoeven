<?php

// src/AppBundle/Controller/IndexController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends Controller {

    /**
     * @route(
     *      path = "/home",
     *      name = "index"
     * ) 
     */
    public function showAction() {
        if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
            if ($_GET["action"] == uitloggen) {
                $_SESSION["aangemeld"] = false;
                unset($_SESSION["winkelmandje"]);
                $_SESSION["prijs"] = 0;

                header("Location: index.php");
                exit(0);
            }
        }

        /* Niet gedefiniëerde variabele een waarde geven om notice te voorkomen */

        if (!isset($_SESSION["aangemeld"])) {
            $_SESSION["aangemeld"] = false;
        }

        error_reporting(E_ALL & ~E_NOTICE);


        return $this->render("Pizzeria/index.html.twig", array("aangemeld" => $_SESSION["aangemeld"]));
    }

}
