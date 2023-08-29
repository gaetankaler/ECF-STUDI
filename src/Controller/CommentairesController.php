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

class CommentairesController extends AbstractController
{
    private $entityManager;
    private $commentairesRepository;

    public function __construct(EntityManagerInterface $entityManager, CommentairesRepository $commentairesRepository)
    {
        $this->entityManager = $entityManager;
        $this->commentairesRepository = $commentairesRepository;
        // $this->note = 0;
    }

/**
 * @Route("/commentaires", name="commentaires")
 */
public function index(PaginatorInterface $paginator, Request $request): Response
{
    $query = $this->commentairesRepository->findAll();
    $commentaires = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        12
    );
    
    return $this->render('pages/commentaires.html.twig', [
        'commentaires' => $commentaires,
    ]);
}

    /**
     * @Route("/commentaire/ajouter", name="ajouter_commentaire")
     */
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
}