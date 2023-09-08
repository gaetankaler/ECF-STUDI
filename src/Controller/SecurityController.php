<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
// use App\Service\EmployeService;
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
    // private $employeService;
    private $entityManager;


    public function __construct(EmployeRepository $repository, Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager; 
        $this->repository = $repository;
        // $this->employeService = $employeService;
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
}