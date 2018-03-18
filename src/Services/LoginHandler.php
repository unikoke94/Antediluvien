<?php

namespace App\Services;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\MailerService;
use App\Form\LoginType;

class LoginHandler
{
	private $formFactory;
	private $mailer;


	public function __construct(FormFactoryInterface $formFactory, MailerService $mailer)
	{
		$this->formFactory = $formFactory;
		$this->mailer = $mailer;
	}

	private function generateForm(Request $request)
	{
		$form = $this->formFactory->create(LoginType::class);
		return $form;
	}

	public function generateData(Request $request)
	{
		$form = $this->generateForm($request);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->mailer->sendMail($form);
		}

		return $form->createView();
	}
	
}