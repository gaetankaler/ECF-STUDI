<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class SecurityController extends AbstractController
{
    private EntityManagerInterface $em;
    private Environment $twig;
    private EmployeRepository $repository;

    public function __construct(EmployeRepository $repository, Environment $twig, EntityManagerInterface $em, ParameterBagInterface $params)
    {
      $this->twig = $twig;
      $this->em = $em;
      $this->repository = $repository; 

    }

    #[Route('security', name: 'index')]
    public function index(): Response
    {
        $employes = $this->repository->findAll();

        return new Response($this->twig->render('admin/employes/index.html.twig', [
            'employes' => $employes, 
        ]));
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
      $error = $authenticationUtils->getLastAuthenticationError();
      $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
        "last_username" =>$lastUsername,
        "error" => $error
    ]);
    }

    #[Route('/security/newEmploye', name: 'admin.security.ajouter_employe')]
    public function newEmploye(Request $request)
    {
    if ($this->isGranted('ROLE_ADMIN')) {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vous pouvez encoder le mot de passe ici si vous utilisez Symfony's PasswordEncoder

            $this->em->persist($employe);
            $this->em->flush();
            $this->addFlash('success', "L'employé a été créé avec succès.");
            return $this->redirectToRoute('index');
        }

        return new Response($this->twig->render("security/ajouter_employe.html.twig", [
            "employe" => $employe,
            'form' => $form->createView()
        ]));
    }

    $this->addFlash("error", "Vous n'êtes pas autorisé à créer un employé.");
    return $this->redirectToRoute('index');
    }

    #[Route('security/editEmploye/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function editEmploye($id, Request $request)
    {
    if ($this->isGranted('ROLE_ADMIN')) {
       $employe = $this->repository->find($id);
        if (!$employe) {
            throw $this->createNotFoundException('employe introuvable.');
        }
        
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
            $employe->setDateEnregistrement(new \DateTime());
            $this->em->persist($employe);
            $this->em->flush();

            $this->addFlash("success", "Employé modifiée avec succès");
            return $this->redirectToRoute('index');

        }
    
        return new Response($this->twig->render("security/ajouter_employe.html.twig", [
            'employe' => $employe,
            'form' => $form->createView()
        ]));
      }
    $this->addFlash("error", "Vous n'êtes pas autorisé à créer un employé.");
    return $this->redirectToRoute('index');
}
    #[Route('/security/supprimer_employe/{id}', name: 'supprimerEmploye', methods: ['DELETE'])]
    public function supprimerEmploye(Employe $employe, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            if ($this->isCsrfTokenValid('supprimer' . $employe->getId(), $request->get('_token'))) {
                $entityManager->remove($employe);
                $entityManager->flush();
                $this->addFlash("success", "Employé supprimé avec succès");
            }
            return $this->redirectToRoute("index");
        }

        $this->addFlash("error", "Vous n'êtes pas autorisé à supprimer un employé.");
        return $this->redirectToRoute('index');
    }
}