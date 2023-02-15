<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login()
    {
        $form = $this->createForm(LoginType::class);

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */

    public function logout(): void
    {

    }
}
