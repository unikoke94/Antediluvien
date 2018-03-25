<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\Video;

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
		$lastPost = $this->postRepo->findOneBy(array(), array('id' => 'DESC'));
		return $lastPost;
	}

	private function generateVideo()
	{
		$lastVideo = $this->videoRepo->findOneBy(array(), array('id' => 'DESC'));
		return $lastVideo;
	}

	public function generateData()
	{
		$lastPost = $this->generatePost();
		$lastVideo = $this->generateVideo();

		return array(
			'post'  => $lastPost,
			'video' => $lastVideo
		);
	}
}