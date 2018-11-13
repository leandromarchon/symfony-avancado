<?php

namespace App\Controller;

use App\Service\Mensagem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(SessionInterface $session)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @param SessionInterface $session
     * @Route("/pegar-sessao")
     */
    public function pegarSessao(SessionInterface $session)
    {
        echo $session->get('frase');
        exit;
    }

    /**
     * @Route("/escrever-mensagem")
     */
    public function escreverMensagem()
    {
        $mensagem = $this->get("mensagem");
        echo $mensagem->escreverMensagem();
        exit;
    }

    /**
     * @Route("/enviar-email")
     * @return Response
     */
    public function email(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message("Hello Symfony 4"))
            ->setFrom('noreplay@email.com')
            ->setTo(array('leandromarchon@hotmail.com' => 'Leandro Marchon'))
            ->setBody($this->renderView("default/index.html.twig", array(
                'controller_name' => 'DefaultController'
            )), "text/html");

        $mailer->send($message);
        return new Response("Email enviado com sucesso!");
    }
}
