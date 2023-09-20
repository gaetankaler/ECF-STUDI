<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use App\Entity\Employe;
use App\Form\VoitureType;
use App\Repository\CommentairesRepository;
use App\Repository\EmployeRepository;
use App\Repository\HoraireGarageRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AdminVoitureController extends AbstractController
{
    private EmployeRepository $employeRepository;
    private VoitureRepository $repository;
    private HoraireGarageRepository $horaires; 
    private Environment $twig;
    private EntityManagerInterface $em;
    private HoraireGarageRepository $horaireGarageRepository;
    
    public function __construct(
        VoitureRepository $repository,
        Environment $twig,
        EntityManagerInterface $em,
        ParameterBagInterface $params,
        EmployeRepository $employeRepository,
        HoraireGarageRepository $horaireGarageRepository
        
    ) {
        $this->repository = $repository;
        $this->twig = $twig;
        $this->em = $em;
        $this->employeRepository = $employeRepository;
        $this->horaires = $horaireGarageRepository;
        $this->horaireGarageRepository = $horaireGarageRepository;
    }
    
#[Route('/admin/voitures', name: 'admin.voitures.index')]
public function index(CommentairesRepository $commentairesRepository): Response
{
    $employes = $this->em->getRepository(Employe::class)->findAll();
    $voitures = $this->em->getRepository(Voiture::class)->findAll();
    $horaires = $this->horaireGarageRepository->findAll();
    $commentairesEnAttente = $commentairesRepository->findBy(['valide' => false], ['created_at' => 'DESC']);

    $this->twig->addGlobal('horaires', $horaires);

    return $this->render('admin\voitures\index.html.twig', [
        'voitures' => $voitures,
        'employes' => $employes,
        'commentairesEnAttente' => $commentairesEnAttente,

    ]);
}
    #[Route('/admin/voitures/new', name: 'admin.voitures.new')]
        public function new(Request $request): Response
        {   

        $horaires = $this->horaireGarageRepository->findAll();
        $voiture = new Voiture(); 
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($voiture);
            $this->em->flush();
            $this->addFlash("success", "Annonce crée avec succès");
            return $this->redirectToRoute('index');
        }

        return new Response($this->twig->render("admin/voitures/new.html.twig", [
            "voiture" => $voiture,
            'form' => $form->createView(),
            'horaires' => $horaires,
        ]));
    }

    #[Route('/admin/voitures/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit($id, Request $request)
    {
        $horaires = $this->horaireGarageRepository->findAll();
        $voiture = $this->repository->find($id);
        if (!$voiture) {
            throw $this->createNotFoundException('Voiture introuvable.');
        }
        
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        if ($voiture->getImageFile() || $voiture->getImageCarousel1() || $voiture->getImageCarousel2() || $voiture->getImageCarousel3()) {
            $voiture->setDate_enregistrement(new \DateTime());
            $this->em->persist($voiture);
            $this->em->flush();

            $this->addFlash("success", "Annonce modifiée avec succès");
            return $this->redirectToRoute('index');
        } else {
            $this->em->flush();
        }
        $this->addFlash("success", "Annonce modifiée avec succès");
        return $this->redirectToRoute('index');
        }
    
        return new Response($this->twig->render("admin/voitures/edit.html.twig", [
            'voiture' => $voiture,
            'form' => $form->createView(),
            'horaires' => $horaires,
        ]));
    }
#[Route('/admin/voitures/{id}', name: 'supprimerVoiture', methods: ['DELETE'])]
public function supprimer(Voiture $voiture, Request $request, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('supprimer' . $voiture->getId(), $request->get('_token'))) {
        $entityManager->remove($voiture);
        $entityManager->flush();
        $this->addFlash("success", "Annonce supprimée avec succès");
    }
    return $this->redirectToRoute("index");
}
}