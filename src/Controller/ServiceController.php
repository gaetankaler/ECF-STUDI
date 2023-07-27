<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ServiceController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    } 

    #[Route("/service")] // Assurez-vous que l'annotation Route est correcte
    public function index(): Response
    {
        return new Response($this->twig->render("pages/service.html.twig"));
    }
}
