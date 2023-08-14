<?php
namespace App\Controller;

use App\Entity\RechercheVoiture;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class OccasionController extends AbstractController
{
    private $twig;
    private $entityManager;
    private $voitureRepository;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, VoitureRepository $voitureRepository)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->voitureRepository = $voitureRepository;
    }

    /**
     * @Route("/occasion")
     */
public function index(PaginatorInterface $paginator, Request $request): Response
{

    $recherche = new RechercheVoiture();
    $form = $this->createForm(RechercheVoitureType::class, $recherche);
    $form->handleRequest($request);

    $voitures = $paginator->paginate(
        $this->voitureRepository->findAllVisibleQuery($recherche),
        $request->query->getInt('page', 1),
        9
    );

    // Vérifier si au moins une voiture existe
    if ($voitures->count() === 0) {
        throw new NotFoundHttpException('Aucune voiture trouvée.');
    }

    return $this->render("pages/occasion.html.twig", [
        "current_menu" => "voitures",
        "voitures" => $voitures,
        "form" => $form->createView()
    ]);
}

    /**
     * @Route("/Occasion/{slug}-{id}", name="voiture.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Voiture $voiture
     * @return Response
     */
    public function show(Voiture $voiture, string $slug): Response
    {
        if ($voiture->getSlug() !==$slug) {
            return $this->redirectToRoute("voiture.show", [
                "id" => $voiture->getId(),
                "slug" => $voiture->getSlug(),
            ], 301);
        }

        return $this->render("voiture.show", [
            "voiture" => $voiture,
            "current_menu" => "voitures",
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function details(int $id): Response
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            throw new NotFoundHttpException('Voiture non trouvée.');
        }

        return new Response($this->twig->render("pages/details.html.twig", [
            'voiture' => $voiture,
        ]));
    }
}
