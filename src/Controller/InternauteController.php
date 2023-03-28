<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Entity\Utilisateur;
use App\Form\InternauteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InternauteController extends AbstractController
{
    /**
     * @Route("/ajoutinternaute/{userId}", name="ajoutinternaute")
     */
    public function ajoutinternaute($userId, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Utilisateur::class);
        $user = $repository->find($userId);
        $internaute = new Internaute();
        $internaute->setNewsletter(false);
        $form = $this->createForm(InternauteType::class, $internaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //$localite = $form->get('localite')->getData();
            //$user->setLocalite($localite);
            $internaute->setProfil($user);
            $entityManager->persist($internaute);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('internaute/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/internaute/{id}", name="internaute")
     */

    public function internaute($id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Internaute::class);
        $internaute = $repository->find($id);

        if (!$internaute) {
            return $this->redirectToRoute('home');
        }

        return $this->render('internaute/internaute.html.twig', [
            'internaute' => $internaute,
        ]);
    }
}
