<?php

namespace App\Services;

use use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\Video;

class ListHandler
{
	private $em;
	private $postRepo;
	private $videoRepo;


	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->videoRepo = $this->em->getRepository(Video::class);
	}

	public function generatePosts()
	{
		//Récupérer tous les articles (pagination ?)
		return $posts;
	}

	public function generateVideos()
	{
		//Récupérer toutes les vidéos (pagination ?)
		return $videos;
	}
}