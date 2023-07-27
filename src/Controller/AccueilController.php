<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AccueilController 
{
  /**
   * @var Environment
   */
  private $twig;

  public function __construct(Environment $twig)
  {
    $this->twig = $twig;
  } 
#[Route("/acceuil")] // Assurez-vous que l'annotation Route est correcte
    public function index(): Response
  {
    return new Response($this->twig->render("pages/accueil.html.twig"));
  }
}