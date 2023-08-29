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


class AccueilController extends AbstractController
{
    private $twig;
    private $doctrine;
    private $logger;

    public function __construct(\Twig\Environment $twig, ManagerRegistry $doctrine, LoggerInterface $logger)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
        $this->logger = $logger;
    }
    /**
     * @Route("/accueil")
     */
    public function index(Request $request, CommentairesRepository $commentairesRepository, ManagerRegistry $doctrine): Response
    {
        $latestCommentaires = $commentairesRepository->findBy([], ['created_at' => 'DESC'], 3);

        $comment = new Commentaires();
        $comment->setCreatedAt(new \DateTime());

        // Création du formulaire avec l'entité Commentaires
        $commentForm = $this->createForm(CommentairesType::class, $comment);
        $commentForm->handleRequest($request);

        // Traiter le formulaire lorsqu'il est soumis
if ($commentForm->isSubmitted() && $commentForm->isValid()) {
    $comment = $commentForm->getData();

    // Récupérer la valeur de la note du formulaire
    $note = $comment->getNote();

    // Mettre à jour la note dans l'entité Commentaires
    $comment->setNote($note);

    $em = $doctrine->getManager();
    $em->persist($comment);
    $em->flush();

    $this->addFlash("success", "Votre commentaire a bien été envoyé");
    return $this->redirectToRoute("accueil");
}



        // Récupérer la valeur de la note du formulaire
        $note = $commentForm->get('note')->getData();
        // dump($noteValue);

        return $this->render("pages/accueil.html.twig", [
            'commentForm' => $commentForm->createView(),
            'latestCommentaires' => $latestCommentaires,
            'note' => $note, // Ajouter la variable note au template
        ]);
    }
}
