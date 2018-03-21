<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Comment;

class AdminCommentHandler
{
	private $em;
	private $commentRepo;
	private $checker;
	private $flusher;

	public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $checker, FlusherService $flusher)
	{
		$this->em = $em;
		$this->commentRepo = $this->em->getRepository(Comment::class);
		$this->flusher = $flusher;
		$this->checker = $checker;
	}

	public function generateComment($id)
	{
		$comment = $this->commentRepo->findBydId($id);
		return $comment;
	}

	public function resetComment($id)
	{
		$comment = $this->generateComment($id);
		$comment->setReported(false);
		$this->flusher->flushEntity($comment);
	}

	public function deleteComment($id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$comment = $this->generateComment($id);
			$this->em->remove($comment);
			$this->em->flush();
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}