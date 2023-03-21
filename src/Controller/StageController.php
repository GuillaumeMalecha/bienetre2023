<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Stage;
use App\Form\StageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StageController extends AbstractController
{
    /**
     * @Route("/stage", name="app_stage")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Stage::class);
        $listeStages = $repository->findAll();

        if (!$listeStages) {
            return $this->redirectToRoute('app_stage_ajout');
        }
        return $this->render('stage/index.html.twig', [
            'stages' => $listeStages,
            'controller_name' => 'StageController',
        ]);
    }

    /**
     * @Route("/detailprestataire/{id}/stage/ajout", name="app_stage_ajout")
     */
    public function ajoutStage(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->find($id);
        $form = $this->createForm(StageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stage = $form->getData();
            $stage->setPrestataire($prestataire);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stage);
            $entityManager->flush();

            return $this->redirectToRoute('app_stage');
        }
        return $this->render('stage/ajout.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'StageController',
            'prestataire' => $prestataire,
        ]);
    }

}
