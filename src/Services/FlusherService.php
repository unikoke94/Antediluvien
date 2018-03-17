<?php

namespace App\Services;

use use Doctrine\ORM\EntityManagerInterface;

class FlusherService
{
	private $em;


	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	public function flushEntity($entity)
	{
		if (is_array($entity)) {
			foreach ($entity as $e) {
				$this->em->persist($e);
			}
		} else {
			$this->em->persist($entity);
		}

		$this->em->flush();
	}
}