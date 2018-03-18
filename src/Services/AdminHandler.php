<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Video;

class AdminHandler
{
	private $em;
	private $postRepo;
	private $commentRepo;
	private $categoryRepo;
	private $videoRepo;


	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->commentRepo = $this->em->getRepository(Comment::class);
		$this->categoryRepo = $this->em->getRepository(Category::class);
		$this->videoRepo = $this->em->getRepository(Video::class);
	}

	private function generatePosts()
	{
		$posts = $this->em->postRepo->findAll();
		return $posts;
	} 

	private function generateCategories()
	{
		$categories = $this->em->categoryRepo->findAll();
		return $categories;
	}

	private function generateVideos()
	{
		$videos = $this->em->videoRepo->findAll();
		return $videos;
	}

	private function generateAllReportedComments()
	{
		$reportedComments = $this->em->commentRepo->findAllReported();
		return $reportedComments;
	}

	public function generateData()
	{
		$posts = $this->generatePosts();
		$categories = $this->generateCategories();
		$videos = $this->generateVideos();
		$reportedComments = $this->generateAllReportedComments();

		return array('posts' => $posts, 'categories' => $categories, 'videos' => $videos, 'reportedComments' => $reportedComments);
	}
}