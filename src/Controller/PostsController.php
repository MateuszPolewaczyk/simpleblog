<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use \Datetime;

class PostsController extends Controller
{
  /**
    * @Route("post/{skip}/{limit}", defaults={"skip" = 0, "limit" = 10}, name="post")
    */
    public function index($skip, $limit)
    {
        $limit < 0 ? $limit = 0 : $limit = $limit;
        $skip < 0 ? $skip = 0 : $skip = $skip;

        $repository = $this->getDoctrine()->getRepository(Post::class);
        
        $pages = ceil(($repository->count([])/$limit));

        $posts = $repository->findBy(
            [],
            [ 'id' => 'DESC' ],
            $limit,
            $skip
        );

        return $this->render('blog/posts.html.twig', array(
            'posts' => $posts,
            'pages' => $pages,
            'limit' => $limit,
            'skip' => $skip
        ));
    }

  /**
    * @Route("post/show/{id}", name="showPost")
    */
    public function showPost($id)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);

        $post = $repository->find($id);

        return $this->render('blog/post.html.twig', array(
            'post' => $post
        ));
    }

  /**
    * @Route("panel/post/edit/{id}", name="editPost")
    */
    public function editPost(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);

        $post = $repository->find($id);

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('text', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->add('saveAndExit', SubmitType::class, array('label' => 'Save and Exit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new DateTime();

            $post = $form->getData();
            $post->setEditionDate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            if ($form->get('saveAndExit')->isClicked()) {
                return $this->redirectToRoute('listPosts', array('skip' => 0, 'limit' => 10));
            }
        }            

        return $this->render('panel/edit_post.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
    * @Route("panel/post/{skip}/{limit}", defaults={"skip" = 0, "limit" = 10}, name="listPosts")
    */
    public function listPosts($skip, $limit)
    {
      $repository = $this->getDoctrine()->getRepository(Post::class);

      $limit < 0 ? $limit = 0 : $limit = $limit;
      $skip < 0 ? $skip = 0 : $skip = $skip;

      $posts = $repository->findBy(
        [],
        [ 'id' => 'DESC' ],
        $limit,
        $skip
      );

      $pages = ceil(($repository->count([])/$limit));

      return $this->render('panel/posts_panel.html.twig', array(
          'posts' => $posts,
          'pages' => $pages,
          'limit' => $limit,
          'skip' => $skip
        ));
    }
    
  /**
    * @Route("create_post", name="createPost")
    */
    public function createPost()
    {       
        $date = new DateTime();

        $em = $this->getDoctrine()->getManager();

        $post = new Post();
        $post->setTitle('New Post');
        $post->setText('Body Text');
        $post->setCreationDate($date);
        $post->setEditionDate($date);
        
        $em->persist($post);
        $em->flush();
        
        return $this->redirectToRoute('listPosts');
    }

  /**
    * @Route("delete_post/{id}", name="deletePost")
    */
    public function deletePost($id)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $em = $this->getDoctrine()->getManager();

        $post = $repository->find($id);

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('listPosts');
    }
}
?>
