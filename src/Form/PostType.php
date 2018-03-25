<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', TextType::class, array(
				'label'    => 'Titre de l\'article',
				'required' => true
				))
			->add('image', FileType::class, array(
				'label'      => 'Image de l\'article',
				'required'   => true
				//"data-class" => null
				))
			->add('categories', EntityType::class, array(
				'class'    => 'App:Category',
				'label'    => 'Catégorie(s)',
				'required' => false
				))
			->add('content', TextareaType::class, array(
				'label'    => 'Contenu de l\'article',
				'required' => true
				))
			->add('Publier', SubmitType::class)
		;	
	}
}