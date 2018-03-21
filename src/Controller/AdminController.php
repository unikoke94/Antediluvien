<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminHandler;
use App\Services\NewPostHandler;
use App\Services\UpdatePostHandler;
use App\Services\DeletePostHandler;
use App\Services\AdminCommentHandler;
use App\Services\NewVideoHandler;
use App\Services\UpdateVideoHandler;
use App\Services\DeleteVideoHandler;
use App\Services\NewCategoryHandler;
use App\Services\UpdateCategoryHandler;
use App\Services\DeleteCategoryHandler;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(AdminHandler $adminHandler)
    {
        $data = $adminHandler->generateData();
        return $this->render('admin/admin.html.twig', array('posts' => $data['posts'], 'reportedComments' => $data['reportedComments'], 'categories' => $data['categories'], 'videos' => $data['videos']));
    }


    /**
     * @Route("/admin/nouvel-article", name="new_post")
     */
    public function newPost(Request $request, NewPostHandler $newPostHandler)
    {
        $form = $newPostHandler->generateData($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/new_post.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/edition-article/{id}", name="edit_post")
     */
    public function editPost(Request $request, UpdatePostHandler $updatePostHandler, $id)
    {
        $form = $updatePostHandler->generateData($request, $id);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/edit_post.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/supprimer-article/{id}", name="delete_post")
     */
    public function deletePost(DeletePostHandler $deletePostHandler, $id)
    {
        $deletePostHandler->deletePost($id);
        return $this->redirectToRoute('admin');
    }


	/**
     * @Route("/admin/remettre-commentaire/{id}", name="reset_comment")
     */
    public function resetComment(AdminCommentHandler $adminCommentHandler, $id)
    {
        $adminCommentHandler->resetComment($id);
        return $this->redirectToRoute('admin');
    }	    


    /**
     * @Route("/admin/supprimer-commentaire/{id}", name="delete_comment")
     */
    public function deleteComment(AdminCommentHandler $adminCommentHandler, $id)
    {
        $adminCommentHandler->deletePost($id);
        return $this->redirectToRoute('admin');
    }


    /**
     * @Route("/admin/nouvelle-video", name="new_video")
     */
    public function newVideo(Request $request, NewVideoHandler $newVideoHandler)
    {
        $form = $newVideoHandler->generateData($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/new_video.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/edition-video/{id}", name="edit_video")
     */
    public function editVideo(Request $request, UpdateVideoHandler $updateVideoHandler, $id)
    {
        $form = $updateVideoHandler->generateData($request, $id);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/edit_video.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/supprimer-video/{id}", name="delete_video")
     */
    public function deleteVideo(DeleteVideoHandler $deleteVideoHandler, $id)
    {
        $deleteVideoHandler->deleteVideo($id);
        return $this->redirectToRoute('admin');
    }


    /**
     * @Route("/admin/nouvelle-categorie", name="new_category")
     */
    public function newCategory(Request $request, NewCategoryHandler $newCategoryHandler)
    {
        $form = $newCategoryHandler->generateData($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/new_category.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/edition-categorie/{id}", name="edit_category")
     */
    public function editCategory(Request $request, UpdateCategoryHandler $updateCategoryHandler, $id)
    {
        $form = $updateCategoryHandler->generateData($request, $id);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/edit_category.html.twig', array('form' => $form));
    }


    /**
     * @Route("/admin/supprimer-categorie/{id}", name="delete_category")
     */
    public function deleteCategory(DeleteCategoryHandler $deleteCategoryHandler, $id)
    {
        $deleteCategoryHandler->deleteCategory($id);
        return $this->redirectToRoute('admin');
    }
}
