<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Category;
use App\Form\CategoryType;

class UpdateCategoryHandler 
{
	private $em;
	private $categoryRepo;
	private $formFactory;
	private $flusher;
	private $checker;


	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, FlusherService $flusher, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->categoryRepo = $this->em->getRepository(Category::class);
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->checker = $checker;
	}


	private function generateCategory($id)
	{
		$category = $this->categoryRepo->findById($id);
		return $category;
	}

	private function generateForm(Category $category)
	{
		$form = $this->formFactory->create(CategoryType::class, $category);
		return $form;
	}

	public function generateData(Request $request, $id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$category = $this->generateCategory($id);
			$form = $this->generateForm($category);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->flusher->flushEntity($category);
			}

			return $form;
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}

}	