<?php

namespace App\Services;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LoginType;

class LoginHandler
{
	private $formFactory;

	public function __construct(FormFactoryInterface $formFactory)
	{
		$this->formFactory = $formFactory;
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
			return $this->redirectToRoute('admin');
		}

		return $form->createView();
	}
	
}