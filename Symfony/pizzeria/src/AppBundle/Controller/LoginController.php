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
        
        $form = $this->createFormBuilder($klant)
                ->setAction($this->generateUrl('index'))
                ->add("email",  EmailType::class)
                ->add("wachtwoord", PasswordType::class)
                ->add("aanmelden", SubmitType::class, array("label" => "aanmelden"))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute("index");
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

        $foutegegevens = false;
        $bestaatniet = false;

        if (isset($_GET["action"])) {//checkt of er iemand wilt inloggen
            if ($_GET["action"] == "login") {
                try {
                    $email = trim($_POST["email"]);
                    $wachtwoord = sha1(trim($_POST["wachtwoord"]));
                    //$resultaat = $klantSvc->controleerKlant($email, $wachtwoord);

                    /*$klant = $this->get("doctrine")
                            ->getManager()
                            ->createQuery("SELECT k FROM AppBundle:Klant k WHERE k.email = " . $email . " AND k.wachtwoord = " . $wachtwoord . "")
                            ->execute();*/
                    $klant = $this->get("doctrine")
                                ->getmanager()
                                ->getRepository("AppBundle:Klant")
                                ->findOneBy(array("email" => $email, "wachtwoord" => $wachtwoord));
                    $resultaat = false;
                    if (isset($klant)) {
                        $resultaat = true;
                        echo($resultaat);
                    }

                    if ($resultaat) {
                        $session->set("aangemeld", true);
                        //$_SESSION["klant"] = $klantSvc->getKlantId($email);
                        /*$klant = $this->get("doctrine")
                                ->getManager()
                                ->createQuery("SELECT k FROM AppBundle:Klant k WHERE k.email = " . $email . "")
                                ->execute();*/
                        /*$klant = $this->get("doctrine")
                                ->getmanager()
                                ->getRepository("AppBundle:Klant")
                                ->findBy(array("email" => $email),
                                        array("wachtwoord" => $wachtwoord));*/
                        $session->set("klant", $klant->getId());

                        setcookie("emailCookie", $email);

                        //$klant = $klantSvc->getKlantById($_SESSION["klant"]);
                        if ($klant->getPromotie() == 1) { //als klant inlogd en winkelmandje al gevuld is, moet prijs herberekend worden
                            if (!empty($session->get("winkelmandje"))) {
                                $session->set("prijs", 0);
                                /* foreach ($_SESSION["winkelmandje"] as $keuze) {
                                  $_SESSION["prijs"] += $keuze->getPromotie();
                                  } */
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
                        return $this->redirect($this->generateUrl('index'));
                    } else { //error handling
                        //$geregistreerd = $klantSvc->controleerGeregistreerd($email);
                        $klant = $this->get("doctrine")
                                ->getmanager()
                                ->getRepository("AppBundle:Klant")
                                ->findOneByEmail($email);
                                        
                        if (isset($klant)) {
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

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld",false);
        }

        if (!isset($_COOKIE["emailCookie"])) {
            $_COOKIE["emailCookie"] = "";
        }

        error_reporting(E_ALL & ~E_NOTICE);

        return $this->render("Pizzeria/inlogform.html.twig", array("aangemeld" => $session->get("aangemeld"), "email" => $_COOKIE["emailCookie"], "foutegegevens" => $foutegegevens, "bestaatniet" => $bestaatniet, "databaseError" => $databaseError, "form" => $form->createView()));
    }

}
