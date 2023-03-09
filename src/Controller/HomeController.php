<?php

namespace App\Controller;

use App\Entity\CategorieServices;
use App\Repository\PrestataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {

        $categorierepository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $categorierepository->findAll();

        //$prestatairesrepository = $entityManager->getRepository(PrestataireRepository::class);
        //$liste4Prestataires = $prestatairesrepository->findAll([], ['id' => 'DESC'], 4);

        return $this->render('home/index.html.twig', [
            'categories' => $listeCategories,
            //'prestataires' => $liste4Prestataires,
        ]);
    }
}
