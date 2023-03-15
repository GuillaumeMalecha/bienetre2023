<?php

namespace App\Controller;

use App\Entity\CategorieServices;
use App\Entity\Prestataire;
use App\Form\CategorieType;
use App\Repository\CategorieServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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

        if (!$listeCategories) {
            return $this->redirectToRoute('ajoutcategorie');
        }

        return $this->render('categorie/index.html.twig', [
            'categories' => $listeCategories,
        ]);
    }


    /**
     * @Route("/ajoutcategorie", name="ajoutcategorie")
     * @IsGranted("ROLE_ADMIN")
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

        // This retrieve the list of prestataires for the category
        $prestataires = $categorie->getPrestataires();


        return $this->render('categorie/detail.html.twig', [
            'categorie' => $categorie,
            'prestataires' => $prestataires,
        ]);
    }

    /**
     * @Route("/detailcategorie/{id}/supprimer", name="supprimercategorie")
     * @IsGranted("ROLE_ADMIN")
     */

    public function supprimercategorie(int $id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $categorie = $repository->find($id);
        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirectToRoute('toutescategories');
    }

    /**
     * @Route("/detailcategorie/{id}/modifier", name="modifiercategorie")
     * @IsGranted("ROLE_ADMIN")
     */

    public function modifiercategorie(int $id, EntityManagerInterface $entityManager, Request $request)
    {
        $repository = $entityManager->getRepository(CategorieServices::class);
        $categorie = $repository->find($id);
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('toutescategories');
            }

        return $this->renderForm('categorie/modifier.html.twig', [
            'form' => $form,
            'categorie' => $categorie,
        ]);
    }
}
