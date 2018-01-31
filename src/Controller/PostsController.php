<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PostsController extends Controller
{
  /**
    * @Route("/post", name="post")
    */
    public function index()
    {
    	$repository = $this->getDoctrine()->getRepository(Post::class);

    	$posts = $repository->findBy(
    		[],
    		[ 'id' => 'DESC' ]
    	);

    	return $this->render('blog/posts.html.twig', array(
        	'posts' => $posts
        ));
    }

  /**
    * @Route("/post/show/{id}", name="showPost")
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
    * @Route("/panel/post/edit/{id}", name="editPost")
    */
    public function editPost(Request $request, $id)
    {
    	$repository = $this->getDoctrine()->getRepository(Post::class);

      $post = $repository->find($id);

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('introText', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

		  $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {

	        $post = $form->getData();

	        $em = $this->getDoctrine()->getManager();
	        $em->persist($post);
	        $em->flush();

	        return $this->redirectToRoute('post');
	    }            

    	return $this->render('blog/writePost.html.twig', array(
    		'form' => $form->createView()
    	));
    }

    /**
    * @Route("/panel/post", name="listPosts")
    */
    public function listPosts()
    {
      $repository = $this->getDoctrine()->getRepository(Post::class);

      $posts = $repository->findBy(
        [],
        [ 'id' => 'DESC' ]
      );

      return $this->render('panel/posts_panel.html.twig', array(
          'posts' => $posts
        ));
    }
    
  /**
    * @Route("/post/create", name="createPost")
    */
    public function createPost()
    {
    	$em = $this->getDoctrine()->getManager();

    	$post = new Post();
      $post->setTitle('New Post');
      $post->setIntroText('Body Text');
      $post->setBodyTextFirst('null xD');

      $em->persist($post);
      $em->flush();

        return $this->redirectToRoute('listPosts');
    }
}
?>
