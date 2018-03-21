<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Category;

class DeleteCategoryHandler
{
	private $em;
	private $categoryRepo;
	private $checker;

	public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->categoryRepo = $this->em->getRepository(Category::class);
		$this->flusher = $flusher;
		$this->checker = $checker;
	}

	private function generateCategory($id)
	{
		$category = $this->categoryRepo->findBydId($id);
		return $category;
	}

	public function deleteCategory($id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$category = $this->generateCategory($id);
			$this->em->remove($category);
			$this->em->flush();
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}