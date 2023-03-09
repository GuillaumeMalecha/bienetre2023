<?php

namespace App\Controller;

use App\Entity\CategorieServices;
use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use Couchbase\SearchResult;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $repository->findAll();

        //$repository = $entityManager->getRepository(Prestataire::class);
        //$prestataires = $repository->find4last();

        //$prestatairesrepository = $entityManager->getRepository(PrestataireRepository::class);
        //$liste4Prestataires = $prestatairesrepository->findAll([], ['id' => 'DESC'], 4);

        return $this->render('home/index.html.twig', [
            'categories' => $listeCategories,
            //'prestataires' => $prestataires
            //'prestataires' => $liste4Prestataires,
        ]);
    }


    /**
     * @Route("/recherche", name="recherche")
     */

    public function recherche(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $repository->findAll();

        return $this->render('home/recherche.html.twig', [
            'categories' => $listeCategories,
        ]);
    }
}
