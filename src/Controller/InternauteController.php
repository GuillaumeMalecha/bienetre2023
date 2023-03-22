<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Form\InternauteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InternauteController extends AbstractController
{
    /**
     * @Route("/ajoutinternaute", name="/ajoutinternaute")
     */
    public function ajoutinternaute(Request $request, EntityManagerInterface $entityManager): Response
    {
        $internaute = new Internaute();
        $form = $this->createForm(InternauteType::class, $internaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($internaute);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('internaute/index.html.twig', [
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
