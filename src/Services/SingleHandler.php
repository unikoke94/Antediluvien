<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\FlusherService;
use App\Form\CommentType;
use App\Entity\Post;
use App\Entity\Comment;

class SingleHandler
{
	private $em;
	private $postRepo;
	private $commentRepo;
	private $flusher;
	private $formFactory;

	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, FlusherService $flusher)
	{
		$this->em = $em;
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->commentRepo = $this->em->getRepository(Comment::class);
	}

	private function generatePost($id)
	{
		//Récupérer le bon post 
		$post = $this->em->postRepo->findById($id);
		return $post;
	}

	private function generateComments($postId)
	{
		//Récupérer les commentaires du bon post
		$comments = $this->em->commentRepo->findByPostId($postId);
		return $comments;
	}

	private function generateForm(Request $request)
	{
		$comment = new Comment();
		$form = $this->formFactory->create(CommentType::class, $comment);
		return array('comment' => $comment, 'form' => $form);
		//Création Form
	}

	public function generateData(Request $request, $id)
	{
		//validation du form avec mise en bdd du commentaire
		//return le bon post
		$post = $this->generatePost($id);
		$comments = $this->generateComments($id);
		$array = $this->generateForm($request);
		$form = $array['form'];
		$comment = $array['comment'];

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$comment->setUsername($form['username']->getData());
			$post->AddComments($comment);
			$this->flusher->flushEntity($post);
		}

		return array('post' => $post, 'form' => $form->createView());
	}

}