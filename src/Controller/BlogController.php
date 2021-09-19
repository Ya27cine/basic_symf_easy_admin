<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{

    const POSTS = [
        ['id' => 1, 'title' => "formation Angular", "slug" => "formation-angular"],
        ['id' => 2, 'title' => "formation ReactJs", "slug" => "formation-reactjs"],
        ['id' => 3, 'title' => "formation Symfony", "slug" => "formation-symfony"],
        ['id' => 4, 'title' => "formation Git", "slug" => "formation-git"],
    ];

    /**
     * @Route("/blog", )
     */
    public function index()
    {
       return new JsonResponse([
            'posts' => self::POSTS
       ]);
       // return $this->render('base.html.twig', ['number' => 9]);
    }

    /**
     * @Route("/blog/{id}", requirements={"id": "\d+"} )
     */
    public function postById($id)
    {
        $item  = array_search($id, array_column(self::POSTS, 'id'));

       return new JsonResponse([
           'Post:id' => self::POSTS[ $item ],
       ]);
    }
    /**
     * @Route("/blog/{slug}", )
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