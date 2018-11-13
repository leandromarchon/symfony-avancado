<?php

namespace App\Controller;

use App\Service\Mensagem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
