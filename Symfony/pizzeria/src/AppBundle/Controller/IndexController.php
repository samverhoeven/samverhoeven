<?php

// src/AppBundle/Controller/IndexController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller {

    /**
     * @route(
     *      path = "/home",
     *      name = "index"
     * ) 
     * @route(
     *      path = "/",
     *      name = "index"
     * ) 
     */
    public function showAction(Request $request) {
        $session = new Session();
        
        if ($request->query->get("action")) { //checkt of er uitgelogd wordt
            
            if ($request->query->get("action") == "uitloggen") {
                $session->set("aangemeld", false);
                $session->remove("winkelmandje");
                $session->set("prijs", 0);
                
                return $this->redirect($this->generateUrl('index'));
            }
        }

        /* Niet gedefiniëerde variabele een waarde geven om notice te voorkomen */

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld",false);
        }
        error_reporting(E_ALL & ~E_NOTICE);


        return $this->render("Pizzeria/index.html.twig", array("aangemeld" => $session->get("aangemeld")));
    }

}
