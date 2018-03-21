<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Services\FlusherService;
use App\Entity\Video;
use App\Form\VideoType;

class NewVideoHandler 
{
	private $formFactory;
	private $flusher;
	private $checker;


	public function __construct(FormFactoryInterface $formFactory, FlusherService $flusher, AuthorizationCheckerInterface $checker)
	{
		$this->formFactory = $formFactory;
		$this->flusher = $flusher;
		$this->checker = $checker;
	}

	private function generateForm()
	{
		$video = new Video();
		$form = $this->formFactory->create(VideoType::class, $video);
		return array('video' => $video, 'form' => $form);
	}


	public function generateData(Request $request)
	{
		if ($this->checker->isGranted('ROLE_ADMIN')) {
			$data = $this->generateForm();
			$video = $data['video'];
			$form = $data['form'];
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {
				$this->flusher->flushEntity($video);
			}

			return $form; 

		} else {
			throw new AccessDeniedException('Accès interdit. Vous ne bénéficiez pas des droits suffisants pour cette page.');
		}
	}
}