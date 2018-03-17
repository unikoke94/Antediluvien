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
     * @Route("/blog/liste", name="blog_list")
     */
    public function blogList(ListHandler $listHandler)
    {
        //Récupérer tous les posts (pagination ?)
        $posts = $listHandler->generatePosts();
        return $this->render('blog/blog_list.html.twig', array('posts' => $posts));
    }


    /**
     * @Route("/blog/article/{id}", name="blog_single")
     */
    public function blogSingle(Request $request, SingleHandler $singleHandler, $id)
    {
    	//Récupérer le post en fonction de l'id (penser aux exceptions)
        $post = $singleHandler->generateData($request, $id);
    	return $this->render('blog/blog_single.html.twig', array('post' => $post));
    }

    //Réfléchir s'il faut faire une méthode pour signaler un commentaire, peut être une méthode privée ?
    private function reportComment()
    {
        //Récupérer le bon commentaire pour le signaler ($comment->setReported = true);
    }
}
