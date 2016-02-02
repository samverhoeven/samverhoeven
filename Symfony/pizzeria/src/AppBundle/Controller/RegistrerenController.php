<?php

// src/AppBundle/Controller/LoginController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Klant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrerenController extends Controller {

    /**
     * @route(
     *      path = "/registreren",
     *      name = "registreren_show"
     * )
     */
    public function registrerenAction(Request $request) {
        $session = new Session();

        $klant = new Klant();

        $form = $this->createFormBuilder($klant, ["attr" => ["id" => "regform"]])
                ->add("naam", TextType::class, array("label" => "Achternaam", "attr" => array("class" => "")))
                ->add("voornaam", TextType::class, array("label" => "Vooraam"))
                ->add("straat", TextType::class, array("label" => "Straat"))
                ->add("huisnummer", IntegerType::class, array("label" => "Huisnummer"))
                ->add("postcode", IntegerType::class, array("label" => "Postcode"))
                ->add("woonplaats", TextType::class, array("label" => "Woonplaats"))
                ->add("telefoon", IntegerType::class, array("label" => "Telefoon"))
                ->add("email", EmailType::class, array("label" => "e-mailadres"))
                ->add("wachtwoord", PasswordType::class, array("label" => "Wachtwoord"))
                ->add("registreren", SubmitType::class, array("label" => "registreren"))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hasemail = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Klant")
                    ->findOneByEmail($form["email"]->getData());
            $klant->setWachtwoord(sha1($form["wachtwoord"]->getData()));
            $klant->setPromotie(0);
            if(!$hasemail) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($klant);
                $em->flush();

                return $this->redirectToRoute("login_show");
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
            return $this->redirect($this->generateUrl('registreren_show'));
        }

        $bestaat = false;
        $veldleeg = false;

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "registreren") {
                try {
                    $email = trim($_POST["email"]);
                    /* $klantSvc = new KlantService();
                      $geregistreerd = $klantSvc->controleerGeregistreerd($email); */
                    $klant = $this->get("doctrine")
                            ->getmanager()
                            ->getRepository("AppBundle:Klant")
                            ->findOneByEmail($email);
                    if (isset($klant)) {
                        $bestaat = true; //error handling
                    } else {
                        if (($_POST["voornaam"] != null) && ($_POST["achternaam"] != null) && ($_POST["straat"] != null) && ($_POST["huisnummer"] != null) && ($_POST["postcode"] != null) && ($_POST["woonplaats"] != null) && ($_POST["telefoon"] != null) && ($_POST["email"] != null) && ($_POST["wachtwoord"] != null)) {
                            $klantSvc->createKlant($_POST["achternaam"], $_POST["voornaam"], $_POST["straat"], $_POST["huisnummer"], $_POST["postcode"], $_POST["woonplaats"], $_POST["telefoon"], $_POST["email"], sha1($_POST["wachtwoord"]));


                            return $this->redirect($this->generateUrl('login_show'));
                        } else {
                            if (($_POST["voornaam"] == null) || ($_POST["achternaam"] == null) || ($_POST["straat"] == null) || ($_POST["huisnummer"] == null) || ($_POST["postcode"] == null) || ($_POST["woonplaats"] == null) || ($_POST["telefoon"] == null) || ($_POST["email"] == null) || ($_POST["wachtwoord"] == null) || ($_POST["wachtwoordCheck"] == null)) {
                                $veldleeg = true; //error handling
                            }
                        }
                    }
                } catch (PDOException $dbe) {
                    $databaseError = "Registreren is op dit moment niet mogelijk.";
                }
            }
        }

        /* Niet gedefiniëerde variabele een waarde geven om notice te voorkomen */

        if (!$session->has("aangemeld")) {
            $session->set("aangemeld", false);
        }

        error_reporting(E_ALL & ~E_NOTICE);

        return $this->render("Pizzeria/registratieform.html.twig", array("aangemeld" => $session->get("aangemeld"), "bestaat" => $bestaat, "veldleeg" => $veldleeg, "databaseError" => $databaseError, "form" => $form->createView()));
    }

}
