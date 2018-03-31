<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Post;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez insérer une image de type JPG ou PNG")
     */
    private $image;


    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getName()
    {
    	return $this->name;
    }

    public function setName($name)
    {
    	$this->name = $name;
    	return $this;
    }

    public function getImage()
    {
    	return $this->image;
    }

    public function setImage($image)
    {
    	$this->image = $image;
    	return $this;
    }
}
