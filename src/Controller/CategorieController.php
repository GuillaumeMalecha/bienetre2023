<?php

namespace App\Controller;

use App\Entity\CategorieServices;
use App\Form\CategorieType;
use App\Repository\CategorieServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="toutescategories")
     */
    public function toutescategorie(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $listeCategories = $repository->findAll();

        if (!$listeCategories){
            return $this->redirectToRoute('ajoutcategorie');
        }

        return $this->render('categorie/index.html.twig', [
            'categories' => $listeCategories,
        ]);
    }



    /**
     * @Route("/ajoutcategorie", name="ajoutcategorie")
     */
    public function ajoutcategorie(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new CategorieServices();
        $categorie->setEnavant('false');
        $categorie->setValide('false');
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('toutescategories');
        }

        return $this->renderForm('categorie/ajouter.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/detailcategorie/{id}", name="detailcategorie")
     */

    public function detailcategorie($id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $categorie = $repository->find($id);

        return $this->render('categorie/detail.html.twig', [
            'categorie' => $categorie
        ]);
    }
}
