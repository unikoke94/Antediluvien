<?php

namespace App\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username', TextType::class, array(
				'label'    => 'Pseudo',
				'required' => true
				))
			->add('password', PasswordType::class, array(
				'label'    => 'Mot de passe',
				'required' => true
				))
			->add('Connexion', SubmitType::class)
		;
	}
}			