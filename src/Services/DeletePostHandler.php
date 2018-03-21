<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Post;

class DeletePostHandler
{
	private $em;
	private $postRepo;
	private $checker;

	public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->flusher = $flusher;
		$this->checker = $checker;
	}

	private function generatePost($id)
	{
		$post = $this->postRepo->findBydId($id);
		return $post;
	}

	public function deletePost($id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$post = $this->generatePost($id);
			$this->em->remove($post);
			$this->em->flush();
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}