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

	public function generatePost($id)
	{ 
		$post = $this->postRepo->findById($id);
		return $post;
	}

	private function generateComment($id)
	{
		$comment = $this->commentRepo->findById($id);
		return $comment;
	}

	private function generateComments($postId)//And categories ?
	{
		$comments = $this->commentRepo->findByPost($postId);
		return $comments;
	}

	private function generateForm()
	{
		$comment = new Comment();
		$form = $this->formFactory->create(CommentType::class, $comment);
		return array('comment' => $comment, 'form' => $form);
	}

	public function reportComment($id)
	{
		$comment = $this->commentRepo->find($id);
		$comment->setReported(true);
		$this->flusher->flushEntity($comment);
	}

	public function generateData(Request $request, $id)
	{
		$post = $this->generatePost($id);
		$comments = $this->generateComments($id);

		if($post != null && $comments != null) {
			$post->setComments($comments);
		}

		$array = $this->generateForm();
		$form = $array['form'];
		$comment = $array['comment'];

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$comment->setUsername($form['username']->getData());
			$post->addComments($comment);
			$this->flusher->flushEntity($post);
		}

		return array(
			'post' => $post, 
			'form' => $form->createView()
		);
	}

}