<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Entity\Voiture;
use App\Entity\HoraireGarage;
use App\Form\HoraireGarageType;
use App\Repository\HoraireGarageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AdminHoraireController extends AbstractController
{
    private HoraireGarageRepository $horaireGarageRepository;
    private Environment $twig;
    private EntityManagerInterface $em;

    public function __construct(HoraireGarageRepository $horaireGarageRepository, Environment $twig, EntityManagerInterface $em)
    {
        $this->horaireGarageRepository = $horaireGarageRepository;
        $this->twig = $twig;
        $this->em = $em;
    }

    public function index(): Response
    {
        $employes = $this->em->getRepository(Employe::class)->findAll();
        $voitures = $this->em->getRepository(Voiture::class)->findAll();
        $horaires = $this->horaireGarageRepository->findAll();

        $this->twig->addGlobal('horaires', $horaires);

        return $this->render('admin/voitures/index.html.twig', [
            'voitures' => $voitures,
            'employes' => $employes,
        ]);
    }

    #[Route('/admin/horaires/newHoraire', name: 'newHoraire')]
    public function newHoraire(Request $request): Response
    {
        $horaire = new HoraireGarage();
        $form = $this->createForm(HoraireGarageType::class, $horaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($horaire);
            $this->em->flush();

            $this->addFlash("success", "Horaire créé avec succès");
            return $this->redirectToRoute('admin_horaires');
        }

        return $this->render('admin/horaires/newhoraire.html.twig', [
            'horaire' => $horaire,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/horaires/editHoraire/{id}', name: 'editHoraire')]
    public function editHoraire(Request $request, HoraireGarage $horaire): Response
    {
        $form = $this->createForm(HoraireGarageType::class, $horaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($horaire);
            $this->em->flush();

            $this->addFlash("success", "Horaire modifié avec succès");
            return $this->redirectToRoute('admin_horaires');
        }

        return $this->render('admin/horaires/editHoraire.html.twig', [
            'horaire' => $horaire,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/horaires/supprimer_horaire/{id}', name: 'supprimerHoraire', methods: ['DELETE'])]
    public function supprimerHoraire(HoraireGarage $horaire, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            if ($this->isCsrfTokenValid('supprimer' . $horaire->getId(), $request->get('_token'))) {
                $entityManager->remove($horaire);
                $entityManager->flush();
                $this->addFlash("success", "Horaire supprimé avec succès");
            }
            return $this->redirectToRoute("admin_horaires");
        }
        $this->addFlash("error", "Vous n'êtes pas autorisé à supprimer un horaire.");
        return $this->redirectToRoute('admin_horaires');
    }
}
