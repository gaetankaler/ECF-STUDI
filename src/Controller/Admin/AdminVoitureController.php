<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\EmployeRepository;
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
    private Environment $twig;
    private EntityManagerInterface $em;
    
    public function __construct(VoitureRepository $repository, Environment $twig, EntityManagerInterface $em, ParameterBagInterface $params, EmployeRepository $employeRepository)
    {
        $this->repository = $repository;
        $this->twig = $twig;
        $this->em = $em;
        $this->employeRepository = $employeRepository;
    }
    #[Route('/admin/voitures', name: 'admin.voitures.index')]
    public function index()
    {
        $voitures = $this->repository->findAll();
        $employes = $this->employeRepository->findAll();
        return new Response($this->twig->render("admin/voitures/index.html.twig", ['voitures' => $voitures, 'employes' => $employes]));
    }
    #[Route('/admin/voitures/new', name: 'admin.voitures.new')]
        public function new(Request $request): Response
        {      
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
            'form' => $form->createView()
        ]));
    }

    #[Route('/admin/voitures/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit($id, Request $request)
    {
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
            'form' => $form->createView()
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