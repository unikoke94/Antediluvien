<?php

namespace App\Services;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginHandler
{
	private $formfactory;


	public function __construct(FormFactoryInterface $formFactory)
	{
		$this->formfactory = $formfactory;
	}

	
}