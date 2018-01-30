<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;

/**
* 
*/
class PanelController extends Controller
{
	/**
	* @Route("/panel", name="panel")
	*/
	public function index()
	{
		return $this->render('panel/panel.html.twig', []);	
	}
}
?>