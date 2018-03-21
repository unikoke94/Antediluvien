<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class VideoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class, array(
				'label'    => 'Titre de la vidéo',
				'required' => true
				))
			->add('url', UrlType::class, array(
				'label'    => 'Lien de la vidéo',
				'required' => true
				))
			->add('Publier', SubmitType::class)
		;	
	}
}