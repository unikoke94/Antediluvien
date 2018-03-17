<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ListHandler;
use App\Services\SingleHandler;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function blogList(ListHandler $listHandler)
    {
        $posts = $listHandler->generatePosts();
        return $this->render('blog/blog_list.html.twig', array('posts' => $posts));
    }


    /**
     * @Route("/blog/article/{id}", name="blog_single")
     */
    public function blogSingle(Request $request, SingleHandler $singleHandler, $id)
    {
        $data = $singleHandler->generateData($request, $id);
    	return $this->render('blog/blog_single.html.twig', array('post' => $data['post'], 'form' => $data['form']));
    }


    private function reportComment()
    {
        //Méthode privée ? Juste dans un service ou dans le controller ?
        //Récupérer le bon commentaire pour le signaler ($comment->setReported = true);
    }
}
