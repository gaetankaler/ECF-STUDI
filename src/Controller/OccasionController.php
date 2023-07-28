<?php
namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Voiture;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class OccasionController
{
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }  
    /**
     * @Route("/occasion")
     */
    public function index(): Response
    {
        // Récupérer une voiture par son ID (exemple avec l'ID 1)
        $voiture = $this->entityManager->getRepository(Voiture::class)->find(1);

        // Vérifier si la voiture existe
        if (!$voiture) {
            throw new NotFoundHttpException('Voiture non trouvée.');
        }

        // Passer la variable $voiture au template Twig pour l'affichage
        return new Response($this->twig->render("pages/occasion.html.twig", [
            'voiture' => $voiture,
        ]));
    }
    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function details(int $id): Response
    {
        // Récupérer la voiture par son ID
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

        // Vérifier si la voiture existe
        if (!$voiture) {
            throw new NotFoundHttpException('Voiture non trouvée.');
        }

        // Passer la variable $voiture au template Twig pour l'affichage des détails
        return new Response($this->twig->render("pages/details.html.twig", [
            'voiture' => $voiture,
        ]));
    }
}
