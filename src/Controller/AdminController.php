<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Services\AdminHandler;

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
    public function newPost()
    {
        //Afficher le form de création de post
        return $this->render('admin/new_post.html.twig', array());
    }


    /**
     * @Route("/admin/edition-article/{id}", name="edit_post")
     */
    public function editPost()
    {
        //Récupérer et afficher le bon article avec le form
        return $this->render('admin/edit_post.html.twig', array());
    }


    /**
     * @Route("/admin/supprimer-article/{id}", name="delete_post")
     */
    public function deletePost()
    {
        //Récupérer le bon post pour l'effacer (et sans doute une redirection à faire)
        return $this->render('admin/admin.html.twig', array());
    }


	/**
     * @Route("/admin/remettre-commentaire/{id}", name="reset_comment")
     */
    public function resetComment()
    {
        //Récupérer le bon commentaire pour le désignaler (et sans doute une redirection à faire)
        return $this->render('admin/admin.html.twig', array());
    }	    


    /**
     * @Route("/admin/supprimer-commentaire/{id}", name="delete_comment")
     */
    public function deleteComment()
    {
        //Récupérer le bon commentaire pour l'effacer (et sans doute une redirection à faire)
        return $this->render('admin/admin.html.twig', array());
    }


    /**
     * @Route("/admin/nouvelle-video", name="new_video")
     */
    public function newVideo()
    {
        //Afficher le form de création de vidéo
        return $this->render('admin/new_video.html.twig', array());
    }


    /**
     * @Route("/admin/edition-video/{id}", name="edit_video")
     */
    public function editVideo()
    {
        //Récupérer et afficher la bonne vidéo avec le form
        return $this->render('admin/edit_video.html.twig', array());
    }


    /**
     * @Route("/admin/supprimer-video/{id}", name="delete_video")
     */
    public function deleteVideo()
    {
        //Récupérer la bonne vidéo pour l'effacer (et sans doute une redirection à faire)
        return $this->render('admin/admin.html.twig', array());
    }


    /**
     * @Route("/admin/nouvelle-categorie", name="new_category")
     */
    public function newCategory()
    {
        //Afficher le form de création de catégorie
        return $this->render('admin/new_category.html.twig', array());
    }


    /**
     * @Route("/admin/edition-categorie/{id}", name="edit_category")
     */
    public function editCategory()
    {
        //Récupérer et afficher la bonne catégorie avec le form
        return $this->render('admin/edit_category.html.twig', array());
    }


    /**
     * @Route("/admin/supprimer-categorie/{id}", name="delete_category")
     */
    public function deleteCategory()
    {
        //Récupérer la bonne catégorie pour l'effacer (et sans doute une redirection à faire)
        return $this->render('admin/admin.html.twig', array());
    }
}
