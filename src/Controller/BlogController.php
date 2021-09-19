<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/{page}", requirements={"page": "\d+"}, name="get-all-posts")
     */
    public function index($page= 7, Request $request)
    {
       return $this->json([
            'page' => $page,
            'limit' => $request->get('limit', 17),
            'posts' => array_map(function ($post){
                    return $this->generateUrl('get-one-post-by-id', ['id' => $post['id'] ]);
                                },
                self::POSTS)

       ]);
       // return $this->render('base.html.twig', ['number' => 9]);
    }

    /**
     * @Route("/post/{id}", requirements={"id": "\d+"}, name="get-one-post-by-id" )
     */
    public function postById($id)
    {
       $item  = array_search($id, array_column(self::POSTS, 'id'));
       return $this->json([
           'Post:id' => self::POSTS[ $item ],
       ]);
    }
    /**
     * @Route("/post/{slug}", name="get-one-post-by-slug")
     */
    public function postBySlug($slug)
    {
       $item  = array_search($slug, array_column(self::POSTS, 'slug'));
       return $this->json([
           'Post:slug' => self::POSTS[ $item ],
       ]);
    }
}



?>