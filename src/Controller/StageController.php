<?php

namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('stage/index.html.twig', [
            'controller_name' => 'StageController',
        ]);
    }

    /**
     * @Route("/stage/ajout", name="app_stage_ajout")
     */
    public function ajoutStage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stage = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stage);
            $entityManager->flush();

            return $this->redirectToRoute('app_stage');
        }
        return $this->render('stage/ajout.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'StageController',
        ]);
    }

}
