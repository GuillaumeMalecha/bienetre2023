<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Form\PromotionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    /**
     * @Route("/promotion", name="app_promotion")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Promotion::class);
        $listePromotions = $repository->findAll();

        if (!$listePromotions) {
            return $this->redirectToRoute('app_promotion_ajout');
        }

        return $this->render('promotion/index.html.twig', [
            'promotions' => $listePromotions,
            'controller_name' => 'PromotionController',
        ]);
    }

    /**
     * @Route("/promotion/ajout", name="app_promotion_ajout")
     */

/*    public function ajoutPromotion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pdfFile = $form->get('pdf')->getData();
            if ($pdfFile) {
                $pdf = new DocumentPdf();
                $fileName = md5(uniqid()) . '.' . $pdfFile->guessExtension();
                $pdfFile->move(
                    $this->getParameter('pdf_directory'),
                    $fileName
                );
                $pdf->setNom($fileName);
                $pdf->setPromotion($promotion);
                $entityManager->persist($pdf);
            }
            //$promotion = $form->getData();
            //$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('app_promotion');
        }
        return $this->render('promotion/ajout.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PromotionController',
        ]);
    }*/

    public function ajoutPromotion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PromotionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promotion = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('app_promotion');
        }

        return $this->render('promotion/ajout.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PromotionController',
        ]);
    }


}
