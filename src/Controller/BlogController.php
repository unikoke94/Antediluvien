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

    /**
     * @Route("/blog/article/{postId}/signalement-commentaire/{id}" name="blog_comment_report")
     */
    /*public function reportComment(SingleHandler $singleHandler, $postId, $id)
    {
        $post = $singleHandler->generatePost($postId);//Vérifier si ça fonctionne avec juste $postId passé en paramètre
        $singleHandler->reportComment($id);
        return $this->redirectToRoute('blog_single', array('id' => $post->getId()));
    }*/
}
