<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
  /**
   * @Route("/", name="home")
   */
  public function index()
  {
    $welcomeMessage = 'Welcome Home!';

    return $this->render('blog/home.html.twig', array(
      'welcome' => $welcomeMessage,
    ));
  }
}

?>
