<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Video;

class AdminHandler
{
	private $em;
	private $checker;
	private $postRepo;
	private $commentRepo;
	private $categoryRepo;
	private $videoRepo;


	public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->checker = $checker;
		$this->postRepo = $this->em->getRepository(Post::class);
		$this->commentRepo = $this->em->getRepository(Comment::class);
		$this->categoryRepo = $this->em->getRepository(Category::class);
		$this->videoRepo = $this->em->getRepository(Video::class);
	}

	private function generatePosts()
	{
		$posts = $this->postRepo->findAllPosts();
		return $posts;
	} 

	private function generateCategories()
	{
		$categories = $this->categoryRepo->findAll();
		return $categories;
	}

	private function generateVideos()
	{
		$videos = $this->videoRepo->findAll();
		return $videos;
	}

	private function generateAllReportedComments()
	{
		$reportedComments = $this->commentRepo->findAllReported();
		return $reportedComments;
	}

	public function generateData()
	{
		if ($this->checker->isGranted('ROLE_ADMIN')) {
			$posts = $this->generatePosts();
			$categories = $this->generateCategories();
			$videos = $this->generateVideos();
			$reportedComments = $this->generateAllReportedComments();

			return array('posts' => $posts, 'categories' => $categories, 'videos' => $videos, 'reportedComments' => $reportedComments);
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}