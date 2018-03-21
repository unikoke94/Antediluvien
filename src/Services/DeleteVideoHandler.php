<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Video;

class DeleteVideoHandler
{
	private $em;
	private $videoRepo;
	private $checker;

	public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->videoRepo = $this->em->getRepository(Video::class);
		$this->flusher = $flusher;
		$this->checker = $checker;
	}

	private function generateVideo($id)
	{
		$video = $this->videoRepo->findBydId($id);
		return $video;
	}

	public function deleteVideo($id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$video = $this->generateVideo($id);
			$this->em->remove($video);
			$this->em->flush();
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}