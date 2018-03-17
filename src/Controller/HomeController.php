<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        //Récupérer last post & last video
        return $this->render('home/homepage.html.twig', array());
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        //Récupérer le form de contact
        return $this->render('home/contact.html.twig', array());
    }


    /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function mentionsLegales()
    {
        return $this->render('home/mentions_legales.html.twig');
    }


}
