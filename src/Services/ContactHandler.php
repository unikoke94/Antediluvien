<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\MailerService;
use App\Form\ContactType;

class ContactHandler
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
		$form = $this->formFactory->create(ContactType::class);
		return $form;
	}

	public function generateData(Request $request)
	{
		$form = $this->generateForm($request);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->mailer->sendMail($form);
			return $this->redirectToRoute('home');
		}

		return $form->createView();
	}
}