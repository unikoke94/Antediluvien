<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Comment;
use App\Entity\Category;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePost;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez insérer une image de type JPG ou PNG")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="post", cascade={"persist"})
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="posts", cascade={"persist"})
     */
    private $categories;



    public function __construct()
    {
    	$this->datePost = new \DateTime();
    	$this->comments = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getTitle()
    {
    	return $this->title;
    }

    public function setTitle($title)
    {
    	$this->title = $title;
    	return $this;
    }

    public function getDatePost()
    {
    	return $this->datePost;
    }

    public function setDatePost($datePost)
    {
    	$this->datePost = $datePost;
    	return $this;
    }

    public function getContent()
    {
    	return $this->content;
    }

    public function setContent($content)
    {
    	$this->content = $content;
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


    public function getComments()
    {
    	return $this->comments;
    }

    public function setComments($comments)
    {
    	$this->comments = $comments;
    	return $this;
    }

    public function addComments(Comment $comments)
    {
    	$this->comments[] = $comments;
    	$comments->setPost($this);

    	return $this;
    }

    public function getCategories()
    {
    	return $this->categories;
    }

    public function setCategories($categories)
    {
    	$this->categories = $categories;
    	return $this;
    }

    public function addCategories(Category $categories)
    {
    	$this->categories[] = $categories;
    	$categories->setPost($this);

    	return $this;
    }

}
