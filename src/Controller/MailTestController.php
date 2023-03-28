<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;

class MailTestController extends AbstractController
{

    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();
        $client->request('GET', '/mail/send');
        $this->assertResponseIsSuccessful();

        $this->assertEmailCount(1); // use assertQueuedEmailCount() when using Messenger

        $email = $this->getMailerMessage();

        $this->assertEmailHtmlBodyContains($email, 'Welcome');
        $this->assertEmailTextBodyContains($email, 'Welcome');
    }

    /**
     * @Route("/mail/controller/test", name="app_mail_controller_test")
     */
    public function index(): Response
    {
        return $this->render('mail_controller_test/index.html.twig', [
            'controller_name' => 'MailTestController',
        ]);
    }


}
