<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use App\Services\LoginHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(LoginHandler $loginHandler, Request $request, AuthenticationUtils $authenticationUtils)
    {
        /*$form = $loginHandler->generateData($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	return $this->redirectToRoute('admin');
        }
        return $this->render('login/login.html.twig', array('form' => $form->createView()));*/
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', array(
        	'last_username' => $lastUsername,
        	'error'         => $error
        	));
    }
}
