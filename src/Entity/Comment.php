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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

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
    private $reported = false;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $post;


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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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

    public function getPost()
    {
    	return $this->post;
    }

    public function setPost(Post $post)
    {
    	$this->post = $post;
    	return $this;
    }
}
