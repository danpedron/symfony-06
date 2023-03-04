<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class SendMailPersonalController extends AbstractDashboardController
{
    #[Route(path: '/admin/envio-de-email-pessoal',name:'app_admin_send_personal_mail')]
    public function sendEmailIndex()
    {
        return $this->render('admin/send_personal_email.html.twig');
    }

    #[Route(path: 'admin/enviando-email-pessoal', name: 'app_admin_sending_personal_mail')]
    public function sendPersonalMail(MailerInterface $mailer, UserRepository $userRepository)
    {
        $allUsers = $userRepository->findAll();

//        foreach ($allUsers as $index => $user) {
//            $email = (new Email())
//                ->from('symfony6@wab.com.br')
//                ->to($user->getEmail())
//                //->cc('cc@example.com')
//                //->bcc('bcc@example.com')
//                ->replyTo('jonaspoli@gmail.com')
//                //->priority(Email::PRIORITY_HIGH)
//                ->subject('Teste den envio de e-mail pessoal')
//                ->html('<p>Parabéns, seu sistema de e-mails funciona!</p>');
//
//            $mailer->send($email);
//            $this->addFlash(
//                'success',
//                'Mensagem enviada com sucesso!'
//            );
//        }

        $email = (new Email())
            ->from('symfony6@wab.com.br')
            ->to($this->getUser()->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo('jonaspoli@gmail.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Teste den envio de e-mail pessoal')
            ->html('<p>Parabéns, seu sistema de e-mails funciona!</p>');

        $mailer->send($email);
        $this->addFlash(
            'success',
            'Mensagem enviada com sucesso!'
        );

        return $this->redirectToRoute('admin');
    }
}