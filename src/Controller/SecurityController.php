<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        return $this->render('login/index.html.twig', ['error' => $utils->getLastAuthenticationError()]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response {

    }

    #[Route('/', name: 'app_main_letsgo')]
    public function home(): Response {
        return $this->render('main/letsgo.html.twig');
    }
}
