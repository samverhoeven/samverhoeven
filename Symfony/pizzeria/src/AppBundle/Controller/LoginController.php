<?php

// src/AppBundle/Controller/LoginController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Klant;

class LoginController extends Controller {

    /**
     * @route(
     *      path = "/login",
     *      name = "login_show"
     * ) 
     */
    public function showAction(Request $request) {
        $session = new Session();

        $databaseError = null;

        $klant = new Klant();

        $foutegegevens = false;
        $bestaatniet = false;

        $form = $this->createFormBuilder($klant, ["attr" => ["id" => "inlogform"]])
                ->add("email", EmailType::class)
                ->add("wachtwoord", PasswordType::class)
                ->add("aanmelden", SubmitType::class, array("label" => "aanmelden"))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $checkklant = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Klant")
                    ->findOneBy(array("email" => $form["email"]->getData(), "wachtwoord" => sha1($form["wachtwoord"]->getData())));
            
            if ($checkklant) {
                $session->set("aangemeld", true);
                $session->set("klant", $checkklant->getId());

                setcookie("emailCookie", $form["email"]->getData());

                if ($checkklant->getPromotie() == 1) { //als klant inlogd en winkelmandje al gevuld is, moet prijs herberekend worden
                    if (!empty($session->get("winkelmandje"))) {
                        $session->set("prijs", 0);
                        $prijs = 0;
                        foreach ($session->get("winkelmandje") as $keuze) {
                            $prijs += $keuze->getPromotie();
                            $session->set("prijs", $prijs);
                        }
                    }
                }

                if ($session->has("bestellen")) {
                    if ($session->get("bestellen")) {
                        $session->set("bestellen", false);
                        return $this->redirect($this->generateUrl('afrekenen_show'));
                    }
                }

                return $this->redirectToRoute("index");
            } else {
                $checkemail = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->findOneByEmail($form["email"]->getData());
                if ($checkemail) {
                    $foutegegevens = true;
                } else {
                    $bestaatniet = true;
                }
            }
        }

        if ($session->has("aangemeld")) {//checkt of er een klant is aangemeld
            if ($session->get("aangemeld")) {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        if (isset($_GET["bestellen"])) {//checkt of gebruiker van bestelpagina komt
            if ($_GET["bestellen"]) {
                $session->set("bestellen", true);
            } else {
                $session->set("bestellen", false);
            }
            return $this->redirect($this->generateUrl('login_show'));
        }

        /* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld", false);
        }

        if (!isset($_COOKIE["emailCookie"])) {
            $_COOKIE["emailCookie"] = "";
        }

        error_reporting(E_ALL & ~E_NOTICE);

        return $this->render("Pizzeria/inlogform.html.twig", array("aangemeld" => $session->get("aangemeld"), "email" => $_COOKIE["emailCookie"], "foutegegevens" => $foutegegevens, "bestaatniet" => $bestaatniet, "databaseError" => $databaseError, "form" => $form->createView()));
    }

}
