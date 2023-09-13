<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Form\RechercheVoitureType;
use App\Notification\ContactNotification;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\HoraireGarageRepository;

class OccasionController extends AbstractController
{
    private $twig;
    private $entityManager;
    private $voitureRepository;
    private $horaireGarageRepository;


    public function __construct(Environment $twig, EntityManagerInterface $entityManager, VoitureRepository $voitureRepository, HoraireGarageRepository $horaireGarageRepository)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->voitureRepository = $voitureRepository;
        $this->horaireGarageRepository = $horaireGarageRepository;

    }

    /**
     * @Route("/occasion")
     */
public function index(PaginatorInterface $paginator, Request $request, HoraireGarageRepository $horaireGarageRepository): Response
{
        $horaires = $this->horaireGarageRepository->findAll();

    $recherche = new RechercheVoiture();
    $form = $this->createForm(RechercheVoitureType::class, $recherche);
    $form->handleRequest($request);

    $voitures = $paginator->paginate(
        $this->voitureRepository->findAllVisibleQuery($recherche),
        $request->query->getInt('page', 1),
        12
    );

    // Vérifier si au moins une voiture existe
    if ($voitures->count() === 0) {
        throw new NotFoundHttpException('Aucune voiture trouvée.');
    }

    return $this->render("pages/occasion.html.twig", [
        "current_menu" => "voitures",
        "voitures" => $voitures,
        "form" => $form->createView(),
        'horaires' => $horaires,
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
    public function details(int $id, Request $request, ContactNotification $notification): Response
{
    $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

    if (!$voiture) {
        throw new NotFoundHttpException('Voiture non trouvée.');
    }

    $contact = new Contact();
    $contact->setVoiture($voiture);
    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $notification->notify($contact);
        $this->addFlash("success", "Votre email a bien été envoyé");
                    return $this->redirectToRoute("detail", [
                "id" => $voiture->getId(),
                "slug" => $voiture->getSlug(),
            ],);
    }
    return $this->render("pages/details.html.twig", [
        'voiture' => $voiture,
        "current_menu" => "voitures",
        'form' => $form->createView()
    ]);
    }
}