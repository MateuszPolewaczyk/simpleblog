<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryController extends Controller
{
  /**
    * @Route("/gallery", name="gallery")
    */
    public function number()
    {
        $number = mt_rand(0, 100);

        return $this->render('blog/gallery.html.twig', array(
          'number' => $number,
        ));
    }
}
?>
