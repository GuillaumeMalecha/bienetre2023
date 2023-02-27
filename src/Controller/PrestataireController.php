<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Form\PrestataireType;
use App\Repository\CategorieServicesRepository;
use App\Repository\PrestataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\DBAL\Types\TextType;


class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataires", name="tousprestataires")
     */
    public function tousprestataires(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $listePrestataires = $repository->findAll();

        if (!$listePrestataires) {
            return $this->redirectToRoute('ajoutprestataire');
        }

        return $this->render('prestataire/index.html.twig', [
            'prestataires' => $listePrestataires,
        ]);
    }


    /**
     * @Route("/ajoutprestataire", name="ajoutprestataire")
     */
    public function ajoutprestataire(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prestataire = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestataire = $form->getData();
            $entityManager->persist($prestataire);
            $entityManager->flush();

            return $this->redirectToRoute('tousprestataires');
        }

        return $this->renderForm('prestataire/ajouter.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/detailprestataire/{id}", name="detailprestataire")
     */

    public function detailprestataire($id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->find($id);

        return $this->render('prestataire/detail.html.twig', [
            'prestataire' => $prestataire
        ]);
    }

    /**
     * @Route("/detailprestataire/{id}/supprimer", name="supprimerprestataire")
     */

    public function supprimerprestataire(int $id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->find($id);
        $entityManager->remove($prestataire);
        $entityManager->flush();

        return $this->redirectToRoute('tousprestataires');
    }

    /**
     * @Route("/detailprestataire/{id}/modifier", name="modifierprestataire")
     */

    public function modifierprestataire(int $id, EntityManagerInterface $entityManager, Request $request)
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->find($id);
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $prestataire = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('tousprestataires');
        }
        return  $this->renderForm('prestataire/modifier.html.twig', [
            'form'=>$form,
            'prestataire'=>$prestataire
        ]);
    }
}
