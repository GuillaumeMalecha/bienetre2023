<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;

class MailTestController extends AbstractController
{

    /**
     * @Route("/mail/test", name="app_mail_test")
     */

    public function sendTestEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('bonjour@bienetre.com')
            ->to('test@bienetre.com')
            ->subject('Test Email')
            ->text('Ceci est un test d\'envoi d\'email');

        $mailer->send($email);

        return $this->redirectToRoute('home');
    }




}
