<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\HoraireGarageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CommentairesController extends AbstractController
{
    private $entityManager;
    private $commentairesRepository;
    private $horaireGarageRepository;


    public function __construct(EntityManagerInterface $entityManager, CommentairesRepository $commentairesRepository, HoraireGarageRepository $horaireGarageRepository)
    {
    $this->entityManager = $entityManager;
    $this->commentairesRepository = $commentairesRepository;
    $this->horaireGarageRepository = $horaireGarageRepository;
    }

    #[Route("/commentaires", name:"commentaires")]
public function index(PaginatorInterface $paginator, Request $request, CommentairesRepository $commentairesRepository): Response
{
    $horaires = $this->horaireGarageRepository->findAll();

    $query = $this->commentairesRepository->findBy(['valide' => true]);
    $commentaires = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        12
    );

    return $this->render('pages/commentaires.html.twig', [
        'commentaires' => $commentaires,
        'horaires' => $horaires,
    ]);
}

    #[Route("/commentaire/ajouter", name:"ajouter_commentaire")]
    public function ajouterCommentaire(Request $request): Response
    {
    $commentaire = new Commentaires();
    $commentaire->setCreatedAt(new \DateTime());

    $commentaireForm = $this->createForm(CommentairesType::class, $commentaire);
    $commentaireForm->handleRequest($request);

    

    if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {

        $this->entityManager->persist($commentaire);
        $this->entityManager->flush();

        $this->addFlash('success', 'Votre commentaire a bien été ajouté.');
        return $this->redirectToRoute('commentaires');
    }
    return $this->render('commentaires/ajouter.html.twig', [
        'commentaireForm' => $commentaireForm->createView(),
    ]);
    }
#[Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYE')")]
#[Route("/valider/commentaire/{id}", name:"validerCommentaire")]
public function validerCommentaire(Commentaires $commentaire, Request $request): Response
{
    if ($request->isMethod('POST') && $this->isCsrfTokenValid("valider" . $commentaire->getId(), $request->get('_token'))) {
        $commentaire->setValide(true);

        $this->entityManager->flush();

        $this->addFlash('success', 'Le commentaire a été validé avec succès.');
    }
    return $this->redirectToRoute('index');
}
#[Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYE')")]
#[Route('/supprimer/commentaire/{id}', name: 'supprimerCommentaire', methods: ['DELETE'])]
public function supprimerCommentaire(Commentaires $commentaire, Request $request, EntityManagerInterface $entityManager): Response 
{ 
    if ($this->isCsrfTokenValid('supprimer' . $commentaire->getId(), $request->get('_token'))) 
    { 
        $entityManager->remove($commentaire); 
        $entityManager->flush();
        $this->addFlash("success", "Commentaire supprimé avec succès"); 
    }
    return $this->redirectToRoute("index"); 
}
}