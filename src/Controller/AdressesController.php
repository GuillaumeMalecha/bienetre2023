<?php

namespace App\Controller;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Localite;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdressesController extends AbstractController
{
    /**
     * @Route("/adresses", name="app_adresses")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('adresses/index.html.twig', [
            'controller_name' => 'AdressesController',
        ]);
    }

    /**
     * @Route("/ajoutadresses", name="ajoutadresses")
     * @IsGranted("ROLE_ADMIN")
     */
    public function ajoutAdresses(EntityManagerInterface $entityManager){

        $json = file_get_contents('../public/data/Region-Ville-CodePostal.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $commune = new Commune();
            $localite = new Localite();
            $cp = new CodePostal();
            $commune->setCommune($item['region']);
            $localite->setLocalite($item['ville']);
            $cp->setCodePostal($item['codePostal']);
            $entityManager->persist($commune);
            $entityManager->persist($localite);
            $entityManager->persist($cp);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_adresses');
    }
}

