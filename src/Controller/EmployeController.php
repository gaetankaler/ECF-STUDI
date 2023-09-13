<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\HoraireGarageRepository;



class EmployeController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;
    private EmployeRepository $employeRepository;
    private Environment $twig;
    private EntityManagerInterface $em;
    private $horaireGarageRepository;


    public function __construct(EmployeRepository $employeRepository, Environment $twig, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, HoraireGarageRepository $horaireGarageRepository)
    {
        $this->employeRepository = $employeRepository;
        $this->twig = $twig;
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
        $this->horaireGarageRepository = $horaireGarageRepository;

    }

public function newEmploye(Request $request): Response
{
    $employe = new Employe();
    $form = $this->createForm(EmployeType::class, $employe);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Hachez le mot de passe avec UserPasswordHasherInterface
        $hashedPassword = $this->passwordHasher->hashPassword($employe, $employe->getPassword());
        $employe->setPassword($hashedPassword);

        $this->em->persist($employe);
        $this->em->flush();

        $this->addFlash("success", "Employé créé avec succès");
        return $this->redirectToRoute('index');
    }

    return $this->render('security/newEmploye.html.twig', [
        'employe' => $employe,
        'form' => $form->createView(),
    ]);
}

public function editEmploye(Request $request, Employe $employe): Response
{
    $form = $this->createForm(EmployeType::class, $employe);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Hachez le mot de passe avec UserPasswordHasherInterface
        $hashedPassword = $this->passwordHasher->hashPassword($employe, $employe->getPassword());
        $employe->setPassword($hashedPassword);

        $this->em->persist($employe);
        $this->em->flush();

        $this->addFlash("success", "Employé modifié avec succès");
        return $this->redirectToRoute('index');
    }

    return $this->render('security/editEmploye.html.twig', [
        'employe' => $employe,
        'form' => $form->createView(),
    ]);
}



#[Route('/security/supprimer_employe/{id}', name: 'supprimerEmploye', methods: ['DELETE'])] 
    public function supprimerEmploye(Employe $employe, Request $request, EntityManagerInterface $entityManager): Response 
    { 
    if ($this->isGranted('ROLE_ADMIN')) 
    { 
    if ($this->isCsrfTokenValid('supprimer' . $employe->getId(), $request->get('_token'))) 
    { 
      $entityManager->remove($employe); 
      $entityManager->flush();
      $this->addFlash("success", "Employé supprimé avec succès"); 
    }
       return $this->redirectToRoute("index"); 
      } 
      $this->addFlash("error", "Vousn'êtes pas autorisé à supprimer un employé."); 
      return $this->redirectToRoute('index'); 
    } 
}