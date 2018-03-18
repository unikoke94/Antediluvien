<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Services\ListHandler;

class VideoController extends Controller
{
    /**
     * @Route("/videos", name="videos_list")
     */
    public function videosList(ListHandler $listHandler)
    {
        $videos = $listHandler->generateVideos();
        return $this->render('video/videos_list.html.twig', array('videos' => $videos));
    }
}
