<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Post;
use App\Form\PostType;

class NewPostHandler 
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
		$post = new Post();
		$form = $this->formFactory->create(PostType::class, $post);
		return array('post' => $post, 'form' => $form);
	}


	public function generateData(Request $request)
	{
		if ($this->checker->isGranted('ROLE_ADMIN')) {
			$data = $this->generateForm();
			$post = $data['post'];
			$form = $data['form'];
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {
				$file = $post->getImage();
				$fileName = md5(uniqid().'.'.$file->guessExtension());
				$file->move(
					$this->container->getParameter('images_directory'),
					$fileName
					);

				$post->setImage($fileName);
				$this->flusher->flushEntity($post);
			}

			return $form; 

		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}