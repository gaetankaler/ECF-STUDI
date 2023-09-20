<?php

namespace App\Controller;

use App\Repository\CommentairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CommentairesType;
use App\Entity\Commentaires;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use App\Repository\HoraireGarageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Doctrine\ORM\Query\Expr;

class AccueilController extends AbstractController
{
    private $twig;
    private $doctrine;
    private $logger;
    private $horaireGarageRepository;
    private $entityManager;

    public function __construct(\Twig\Environment $twig, EntityManagerInterface $entityManager, ManagerRegistry $doctrine, LoggerInterface $logger, HoraireGarageRepository $horaireGarageRepository)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
        $this->logger = $logger;
        $this->horaireGarageRepository = $horaireGarageRepository;
        $this->entityManager = $entityManager;
    }

    #[Route("/accueil", name: "index")]
    public function index(Request $request, CommentairesRepository $commentairesRepository, ManagerRegistry $doctrine, AuthorizationCheckerInterface $authorizationChecker): Response
    {
        $latestCommentaires = $this->entityManager
            ->getRepository(Commentaires::class)
            ->createQueryBuilder('c')
            ->where('c.valide = :valide')
            ->setParameter('valide', true)
            ->orderBy('c.created_at', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
 $latestCommentaires = array_slice($latestCommentaires, 0, 3);
        $comment = new Commentaires();
        $comment->setCreatedAt(new \DateTime());

        $commentForm = $this->createForm(CommentairesType::class, $comment);
        $commentForm->handleRequest($request);
        $horaires = $this->horaireGarageRepository->findAll();

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();
            $note = $comment->getNote();
            $comment->setNote($note);

            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->flush();

            $latestCommentaires = $this->entityManager
                ->getRepository(Commentaires::class)
                ->createQueryBuilder('c')
                ->where('c.valide = :valide')
                ->setParameter('valide', true)
                ->orderBy('c.created_at', 'DESC')
                ->setMaxResults(3)
                ->getQuery()
                ->getResult();
 $latestCommentaires = array_slice($latestCommentaires, 0, 3);
            $this->addFlash("success", "Votre commentaire a bien été ajouté. Il est en attente de validation.");
            return $this->redirectToRoute("accueil");
        }
        $note = $commentForm->get('note')->getData();
        $horaires = $this->horaireGarageRepository->findAll();

        return $this->render("pages/accueil.html.twig", [
            'commentForm' => $commentForm->createView(),
            'latestCommentaires' => $latestCommentaires,
            'note' => $note,
            'horaires' => $horaires,
        ]);
    }
}