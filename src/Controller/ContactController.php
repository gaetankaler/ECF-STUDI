<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\HoraireGarageRepository;

class ContactController
{
    /**
     * @var Environment
     */
    private $twig;
    private $horaireGarageRepository;


    public function __construct(Environment $twig, HoraireGarageRepository $horaireGarageRepository)
    {
        $this->twig = $twig;
        $this->horaireGarageRepository = $horaireGarageRepository;

    } 
    /**
     * @Route("/contact")
     */
    public function index(): Response
    {
        $horaires = $this->horaireGarageRepository->findAll();

        return new Response($this->twig->render("pages/contact.html.twig", [
            'horaires' => $horaires,
        ]));
    }
}