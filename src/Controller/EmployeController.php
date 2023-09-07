<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController
{
    #[Route('/ajouter-employe', name: 'ajouter_employe')]
    public function ajouterEmploye(): Response
    {
        return $this->render('employe/ajouter.html.twig');
    }
}