<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Services\LoginHandler;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(LoginHandler $loginHandler, Request $request)
    {
        $form = $loginHandler->generateData($request);
        return $this->render('login/login.html.twig', array('form' => $form));
    }
}
