<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Video;
use App\Form\VideoType;

class UpdateVideoHandler 
{
	private $em;
	private $videoRepo;
	private $formFactory;
	private $flusher;
	private $checker;


	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, FlusherService $flusher, AuthorizationCheckerInterface $checker)
	{
		$this->em = $em;
		$this->videoRepo = $this->em->getRepository(Video::class);
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->checker = $checker;
	}


	private function generateVideo($id)
	{
		$video = $this->videoRepo->findById($id);
		return $video;
	}

	private function generateForm(Video $video)
	{
		$form = $this->formFactory->create(VideoType::class, $video);
		return $form;
	}

	public function generateData(Request $request, $id)
	{
		if ($this->checker->isGrandted('ROLE_ADMIN')) {
			$video = $this->generateVideo($id);
			$form = $this->generateForm($video);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->flusher->flushEntity($video);
			}

			return $form;
		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}

}	