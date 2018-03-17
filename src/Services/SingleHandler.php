<?php

namespace App\Services;

use use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Entity\Comment;

class SingleHandler
{
	private $em;
	private $postRepo;
	private $commentRepo;
	private $flusher;
	private $formFactory;

	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory)
	{
		$this->em = $em;
		$this->formFactory = $formFactory;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->commentRepo = $this->em->getRepository(Comment::class);
	}

	private function generatePost($id)
	{
		//Récupérer le bon post 
	}

	private function generateComments($idPost)
	{
		//Récupérer les commentaires du bon post
	}

	private function generateForm(Request $request)
	{
		$comment = new Comment();
		//Création Form
	}

	public function generateData(Request $request, $id)
	{
		//validation du form avec mise en bdd du commentaire
		//return le bon post
	}

}