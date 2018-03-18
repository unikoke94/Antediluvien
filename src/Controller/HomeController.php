<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Services\HomepageHandler;
use App\Services\ContactHandler;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(HomepageHandler $homeHandler)
    {
        $data = $homeHandler->generateData();
        return $this->render('home/homepage.html.twig', array($data));
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ContactHandler $contactHandler)
    {
        $form = $contactHandler->generateData($request);
        return $this->render('home/contact.html.twig', array('form' => $form));
    }


    /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function mentionsLegales()
    {
        return $this->render('home/mentions_legales.html.twig');
    }


}
