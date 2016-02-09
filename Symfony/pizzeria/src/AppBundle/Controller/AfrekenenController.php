<?php

// src/AppBundle/Controller/AfrekenenController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Bestelling;
use AppBundle\Entity\Bestelregel;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class AfrekenenController extends Controller {

    /**
     * @route(
     *      path = "/afrekenen",
     *      name = "afrekenen_show"
     * ) 
     */
    public function afrekenenAction(Request $request) {
        $session = new Session();

        if ($this->getUser()) {//checkt of er een klant is aangemeld
                $klant = $this->get("doctrine")
                        ->getmanager()
                        ->getRepository("AppBundle:Klant")
                        ->find($this->getUser()->getId());
        }

        if ($request->query->get("verwijder")) { //checkt of er een item uit winkelmandje moet verwijderd worden
            $verwijder = $request->query->get("verwijder"); // id van product dmv key uit de array winkelmandje 

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

        if ($request->query->get("besteld")) { //bestellingsgegevens in juiste tabellen zetten
            $datetime = new DateTime("now");
            
            $bestelling = new Bestelling();
            $bestelling->setKlantid($this->getUser()->getId());
            $bestelling->setPrijs($session->get("prijs"));
            $bestelling->setDatum($datetime);

            $em = $this->getDoctrine()->getManager();
            $em->persist($bestelling);
            $em->flush();
            $bestellingId = $bestelling->getId();
            
            foreach (($session->get("winkelmandje")) as $product) {
                $bestreg = new Bestelregel();
                if ($klant->getPromotie() == 1) { //checkt of promotieprijs of gewone prijs aan bestreg moet meegegeven worden
                    $bestreg->setBestelid($bestellingId);
                    $bestreg->setProductid($product->getId());
                    $bestreg->setPrijs($product->getPromotie());
                } else {
                    $bestreg->setBestelid($bestellingId);
                    $bestreg->setProductid($product->getId());
                    $bestreg->setPrijs($product->getPrijs());
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($bestreg);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('afrekenen_show', array("bestelcheck" => "true")));
        }

        if ($request->query->get("bestelcheck")) { //checkt of bestelling is geplaatst om overzicht te tonen
            $bestelcheck = true;
            
            $session->remove("winkelmandje");
            $session->set("prijs", 0);
            
            $producten = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Product")
                    ->findAll();
            
            $bestelling = $this->get("doctrine")
                    ->getmanager()
                    ->createQuery("SELECT b FROM AppBundle:Bestelling b WHERE b.klantid = ". $this->getUser()->getId() ." ORDER BY b.datum DESC")
                    ->setMaxResults(1)
                    ->getSingleResult();
            
            $bestregels = $this->get("doctrine")
                    ->getmanager()
                    ->getRepository("AppBundle:Bestelregel")
                    ->findByBestelid($bestelling->getId());
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

        if (!isset($bestelcheck)) {
            $bestelcheck = false;
        }

        if (!$session->has("winkelmandje")) {
            $session->set("winkelmandje", []);
        }

        return $this->render("Pizzeria/afrekening.html.twig", array("winkelmandje" => $session->get("winkelmandje"),
                    "totaalprijs" => $session->get("prijs"), "aangemeld" => $this->getUser(),
                    "bestelcheck" => $bestelcheck, "bestelling" => $bestelling, "bestregels" => $bestregels,
                    "producten" => $producten, "klant" => $klant));
    }

}
