<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Category;
use App\Form\CategoryType;

class NewCategoryHandler 
{
	private $formFactory;
	private $flusher;
	private $container;
	private $checker;


	public function __construct(FormFactoryInterface $formFactory, FlusherService $flusher, ContainerInterface $container, AuthorizationCheckerInterface $checker)
	{
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->container = $container;
		$this->checker = $checker;
	}

	private function generateForm()
	{
		$category = new Category();
		$form = $this->formFactory->create(CategoryType::class, $category);
		return array('category' => $category, 'form' => $form);
	}


	public function generateData(Request $request)
	{
		if ($this->checker->isGranted('ROLE_ADMIN')) {
			$data = $this->generateForm();
			$category = $data['category'];
			$form = $data['form'];
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {
				$file = $category->getImage();
				$fileName = md5(uniqid()).'.'.$file->guessExtension();
				$file->move(
					$this->container->getParameter('images_directory'), $fileName
				);

				$category->setImage($fileName);
				$this->flusher->flushEntity($category);
			}

			return $form; 

		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}