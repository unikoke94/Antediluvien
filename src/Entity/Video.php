<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
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
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     */
    private $youtubeId;


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

    public function getUrl()
    {
    	return $this->url;
    }

    public function setUrl($url)
    {
    	$this->url = $url;
    	return $this;
    }

    public function getYoutubeId()
    {
        //$array = explode('=', $this->url);
        //$this->youtubeId = array_pop($array);
        return $this->youtubeId;
    }

    public function setYoutubeId($youtubeId)
    {
        $this->youtubeId = $youtubeId;
        return $this;
    }
}
