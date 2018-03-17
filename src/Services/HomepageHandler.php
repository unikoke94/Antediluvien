<?php

namespace App\Services;

use use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Enityt\Video;

class HomepageHandler
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

	private function generatePost()
	{
		//Requête pour récupérer le dernier post
	}

	private function generateVideo()
	{
		//Requête pour récupérer la dernière vidéo
	}

	public function generateData()
	{
		$lastPost = $this->generatePost();
		$lastVideo = $this->generateVideo();

		return array(
			'lastPost'  => $lastPost,
			'lastVideo' => $lastVideo
			);
	}
}