<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/hello/{name}", name="Hello")
     * @param $name: desired name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helloAction($name){
        return $this->render('default/hello.html.twig', array('name' =>$name));
    }

    /**
     * @Route("bite/{title}", name="Anime2")
     * @param $title
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function animeTitleAction($title){
        return $this->render('default/anime.html.twig', array('title' =>$title));
    }

    /**
     * @Route("legacy", name="legacy")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function firstLayoutAction(){
        return $this->render('default/main.html.twig');
    }

    /**
     * @Route("contact", name="Contact")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(){
        return $this->render('default/contact.html.twig');
    }
}
