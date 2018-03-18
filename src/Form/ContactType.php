<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('firstname', TextType::class, array(
				'label'    => 'Prénom',
				'required' => true
				))
			->add('lastname', TextType::class, array(
				'label'    => 'Nom',
				'required' => true
				))
			->add('email', EmailType::class, array(
				'label'    => 'Email',
				'required' => true
				))
			->add('subject', TextType::class, array(
				'label'    => 'Sujet',
				'required' => true
				))
			->add('message', TextareaType::class, array(
				'label'    => 'Message',
				'required' => true
				))
			->add('Envoyer', SubmitType::class)
			->getForm()
		;	
	}
}