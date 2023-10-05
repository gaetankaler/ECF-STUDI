<?php

namespace App\Controller;

use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\HoraireGarageRepository;


class SecurityController extends AbstractController
{
    private Environment $twig;
    private EmployeRepository $repository;
    private $entityManager;
    private $horaireGarageRepository;



    public function __construct(EmployeRepository $repository, Environment $twig, EntityManagerInterface $entityManager, 
    HoraireGarageRepository $horaireGarageRepository)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager; 
        $this->repository = $repository;
        $this->horaireGarageRepository = $horaireGarageRepository;

    }

    #[Route('security', name: 'index')]
    public function index(): Response
    {

        $horaires = $this->horaireGarageRepository->findAll();

        $employes = $this->repository->findAll();

        return new Response($this->twig->render('admin/employes/index.html.twig', [
            'employes' => $employes, 
            'horaires' => $horaires,
        ]));
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        
        $horaires = $this->horaireGarageRepository->findAll();

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
        "last_username" =>$lastUsername,
        "error" => $error,
        'horaires' => $horaires,
    ]);
    }
}