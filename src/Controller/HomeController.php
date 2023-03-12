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

        $repository = $entityManager->getRepository(Prestataire::class);
        $derniersPrestataires = $repository->findBy([], ['id' => 'DESC'], 4);

        return $this->render('home/index.html.twig', [
            'categories' => $listeCategories,
            'derniersPrestataires' => $derniersPrestataires,
        ]);
    }


    /**
     * @Route("/recherche", name="recherche")
     */

    public function recherche(EntityManagerInterface $entityManager, Request $request): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $repository->findAll();

        //dd($request->request->all());

        $formData = $request->request->all();

        $nom = $formData['nom'] ?? null;
        $categorieId = $formData['categorie'] ?? null;
        $categorieServiceId = $formData['categorie_service'] ?? null;

        $repository = $entityManager->getRepository(Prestataire::class);
        $rechercheNom = $entityManager->createQueryBuilder()
            ->select('e')
            ->from(Prestataire::class, 'e')
            ->where('e.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%');

        $repository = $entityManager->getRepository(CategorieServices::class);
        if ($categorieServiceId) {
            $rechercheNom->innerJoin('e.categoriesServices', 'f')
                ->andWhere('f.id = :id')
                ->setParameter('id', $categorieServiceId);
        }

        $rechercheNom = $rechercheNom->getQuery()
            ->getResult();

        return $this->render('home/recherche.html.twig', [
            'categories' => $listeCategories,
            'recherchenom' => $rechercheNom,
            'noms' => $nom,
            'categorieserviceid' => $categorieServiceId,
        ]);
    }
}
