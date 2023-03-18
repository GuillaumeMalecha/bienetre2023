<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Prestataire;
use App\Entity\Promotion;
use App\Entity\Stage;
use App\Form\PrestataireType;
use App\Repository\CategorieServicesRepository;
use App\Repository\PrestataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function ajoutprestataire(Request $request, EntityManagerInterface $entityManager): Response
    {

        $prestataire = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagesFile = $form->get('images')->getData();
            if ($imagesFile) {
                $images = new Images();
                $fileName = md5(uniqid()) . '.' . $imagesFile->guessExtension();
                $imagesFile->move(
                    $this->getParameter('pictures_directory'),
                    $fileName
                );
                $images->setImage($fileName);
                $prestataire->setImages($images);
            } else {
                $prestataire->setImages(null);
            }

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

        $repository = $entityManager->getRepository(Promotion::class);
        $promotions = $repository->findBy(['prestataire' => $id]);

        $repository = $entityManager->getRepository(Stage::class);
        $stages = $repository->findBy(['prestataire' => $id]);

        return $this->render('prestataire/detail.html.twig', [
            'prestataire' => $prestataire,
            'promotions' => $promotions,
            'stages' => $stages,
        ]);
    }

    /**
     * @Route("/detailprestataire/{id}/supprimer", name="supprimerprestataire")
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
     */

    public function modifierprestataire(int $id, EntityManagerInterface $entityManager, Request $request)
    {
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->find($id);
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form->get('images')->getData();

            if($file){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('pictures_directory'),
                    $fileName
                );
                $image = new Images();
                $image->setImage($fileName);
                $prestataire->setPhoto($image);
                $entityManager->persist($image);
            }
            $prestataire = $form->getData();
            $entityManager->persist($prestataire);
            $entityManager->flush();

            return $this->redirectToRoute('tousprestataires');
        }
        return  $this->renderForm('prestataire/modifier.html.twig', [
            'form'=>$form,
            'prestataire'=>$prestataire
        ]);
    }
}
