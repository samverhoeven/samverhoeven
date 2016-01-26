<?php

// src/AppBundle/Controller/BlogController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller {

    public function indexAction(){
        return BlogController::listAction();
    }
    
    /**
     * @route(
     *      path = "/blog/{page}",
     *      name = "blog_list",
     *      defaults = {"page" : "1"},
     *      requirements = {"page" : "\d+"}
     * ) 
     */
    public function listAction($page) {
        $posts = $this->get('doctrine')
                ->getManager()
                ->createQuery('SELECT p FROM AppBundle:Post p')
                ->execute();
        return $this->render('Blog/list.html.twig', array('posts' => $posts));
    }
    
    /**
     * 
     * @route(
     *      path = "/blog/{title}",
     *      name = "blog_show",
     *      defaults = {"title" : "1"}
     * )
     */
    public function showAction($title) {
        $post = $this->get('doctrine')
                ->getManager()
                ->getRepository('AppBundle:Post')
                ->findOneByUrl($title);
        if (!$post) {
// cause the 404 page not found to be displayed
            return $this->redirect($this->generateUrl('blog_list')); //title van route in routing.yml
            //throw $this->createNotFoundException("This post does not exist!");
        }
        return $this->render('Blog/show.html.twig', array('post' => $post));
    }
    
}
