<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Repository\CategorieServicesRepository;
use App\Repository\PrestataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire", name="prestataire")
     */
    public function index(PrestataireRepository $prestataire, CategorieServicesRepository $categorieServices)
    {
        return $this->render('prestataire/liste.html.twig', [
            'prestataires' => $prestataire->findAllData(),
        ]);
    }

    /**
     * @Route("/prestataire", name="ajoutprestataire")
     */
    public function ajoutprestataire(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prestataire = new Prestataire();

    }
}
