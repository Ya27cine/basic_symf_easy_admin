<?php 

namespace App\Controller;

use App\Entity\Post;
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
     * @Route("/post/add", name="add-post", methods={"POST"})
     * */
    public function add(Request $request){
        $serializer = $this->get('serializer');
        $post = $serializer->deserialize($request->getContent(), Post::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist( $post ); // preparation la req SQL
        $em->flush(); // exec la req sal

        return $this->json( $post );
    }

    /**
     * @Route("/{page}", requirements={"page": "\d+"}, name="get-all-posts")
     */
    public function index($page= 7, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repository->findAll();

        return $this->json([
            'page' => $page,
            'limit' => $request->get('limit', 17),
            'posts' => array_map(function (Post $post) {
                    return [
                        'title' => $post->getTitle(),
                        'user' => $post->getAuthor(),
                        'url' => $this->generateUrl('get-one-post-by-id', ['id' => $post->getId() ])
                    ];
                    },$posts)
        ]);
       // return $this->render('base.html.twig', ['number' => 9]);
    }

    /**
     * @Route("/post/{id}", requirements={"id": "\d+"}, name="get-one-post-by-id" )
     */
    public function postById($id=1)
    {
       //$item  = array_search($id, array_column(self::POSTS, 'id'));
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->find($id);

       return $this->json([
           'Post:id' => $post,
       ]);
    }
    /**
     * @Route("/post/{slug}", name="get-one-post-by-slug")
     */
    public function postBySlug($slug)
    {
       //$item  = array_search($slug, array_column(self::POSTS, 'slug'));
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->findOneBy(['slug' => $slug ]);
       return $this->json([
           'Post:slug' => $post,
       ]);
    }
}



?>