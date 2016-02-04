<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request) {
        $session = new Session();
              
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'Pizzeria/login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                    "aangemeld" => $session->get("aangemeld")        
                        )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }

}
