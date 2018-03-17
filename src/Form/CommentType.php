<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username', TextType::class, array(
				'label'    => 'Pseudo',
				'required' => true
				))
			->add('content', TextareaType::class, array(
				'label'    => 'Message',
				'required' => true
				))
			->add('Poster', SubmitType::class)
		;	
	}
}