<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ContactController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    } 
    /**
     * @Route("/contact")
     */
    public function index(): Response
    {
        return new Response($this->twig->render("pages/contact.html.twig"));
    }
}