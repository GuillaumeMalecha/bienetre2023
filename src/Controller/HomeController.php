<?php

namespace App\Controller;

use App\Entity\CategorieServices;
use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use Couchbase\SearchResult;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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

        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataires = $repository->findAll();
        $derniersPrestataires = $repository->findBy([], ['id' => 'DESC'], 4);

        return $this->render('home/index.html.twig', [
            'categories' => $listeCategories,
            'prestataires' => $prestataires,
            'derniersPrestataires' => $derniersPrestataires,
        ]);
    }


    /**
     * @Route("/recherche", name="recherche")
     */

    public function recherche(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $repository->findAll();

        $formData = $request->request->all();

        $nom = $formData['nom'] ?? null;
        $categorieId = $formData['categorie'] ?? null;
        $commune = $formData['commune'] ?? null;

        $repository = $entityManager->getRepository(Prestataire::class);
        $rechercheNom = $repository->findByRecherche($nom, $categorieId, $commune);

        $pagination = $paginator->paginate(
            $rechercheNom,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('home/recherchepagination.html.twig', [
            'categories' => $listeCategories,
            'recherchenom' => $rechercheNom,
            'noms' => $nom,
            'pagination' => $pagination,
        ]);
    }
}
