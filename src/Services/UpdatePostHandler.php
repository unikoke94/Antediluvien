<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Post;
use App\Form\PostType;

class UpdatePostHandler 
{
	private $em;
	private $postRepo;
	private $formFactory;
	private $flusher;
	private $checker;


	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, FlusherService $flusher, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->checker = $checker;
	}


	private function generatePost($id)
	{
		$post = $this->postRepo->findById($id);
		return $post;
	}

	private function generateForm(Post $post)
	{
		$form = $this->formFactory->create(PostType::class, $post);
		return $form;
	}

	public function generateData(Request $request, $id)
	{
		if ($this->checker->isGranted('ROLE_ADMIN')) {
			$post = $this->generatePost($id);
			$form = $this->generateForm($post);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->flusher->flushEntity($post);
			}

			return $form;
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}

}	