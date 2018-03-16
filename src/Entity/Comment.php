<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Post;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
    private $username;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComment;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reported;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $posts;


    public function __construct()
    {
    	$this->dateComment = new \DateTime();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getUsername()
    {
    	return $this->username;
    }

    public function setUsername($username)
    {
    	$this->username = $username;
    	return $this;
    }

    public function getDateComment()
    {
    	return $this->dateComment;
    }

    public function setDateComment($dateComment)
    {
    	$this->dateComment = $dateComment;
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

    public function getReported()
    {
    	return $this->reported;
    }

    public function setReported($reported)
    {
    	$this->reported = $reported;
    	return $this;
    }

    public function getPosts()
    {
    	return $this->posts;
    }

    public function setPosts(Post $post)
    {
    	$this->posts = $posts;
    	return $this;
    }
}
