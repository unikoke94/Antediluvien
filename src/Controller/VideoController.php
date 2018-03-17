<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VideoController extends Controller
{
    /**
     * @Route("/videos", name="videos_list")
     */
    public function videosList()
    {
        //Récupérer toutes les vidéos (pagination ?)
        return $this->render('video/videos_list', array());
    }
}
