<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/blog", )
     */
class BlogController extends AbstractController
{

    const POSTS = [
        ['id' => 1, 'title' => "formation Angular", "slug" => "formation-angular"],
        ['id' => 2, 'title' => "formation ReactJs", "slug" => "formation-reactjs"],
        ['id' => 3, 'title' => "formation Symfony", "slug" => "formation-symfony"],
        ['id' => 4, 'title' => "formation Git", "slug" => "formation-git"],
    ];

    /**
     * @Route("/{page}", requirements={"page": "\d+"})
     */
    public function index($page= 7)
    {
       return new JsonResponse([
            'page' => $page,
            'posts' => self::POSTS
       ]);
       // return $this->render('base.html.twig', ['number' => 9]);
    }

    /**
     * @Route("/post/{id}", requirements={"id": "\d+"} )
     */
    public function postById($id)
    {
       $item  = array_search($id, array_column(self::POSTS, 'id'));
       return new JsonResponse([
           'Post:id' => self::POSTS[ $item ],
       ]);
    }
    /**
     * @Route("/post/{slug}", )
     */
    public function postBySlug($slug)
    {
       $item  = array_search($slug, array_column(self::POSTS, 'slug'));
       return new JsonResponse([
           'Post:slug' => self::POSTS[ $item ],
       ]);
    }
}



?>