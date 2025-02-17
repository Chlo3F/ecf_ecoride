<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends AbstractController
{
    use TargetPathTrait;

    #[Route('/connexion', name: 'connexion')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        if ($user) {
            // Redirection selon le rôle
            if (in_array('ROLE_ADMIN', $user->getRoles())) {
                return $this->redirectToRoute('admin_dashboard');
            } elseif (in_array('ROLE_EMPLOYE', $user->getRoles())) {
                return $this->redirectToRoute('employe_dashboard');
            } elseif (in_array('ROLE_CONDUCTEUR', $user->getRoles())) {
                return $this->redirectToRoute('conducteur_compte');
            } else {
                return $this->redirectToRoute('passager_compte');
            }
        }

        return $this->render('connexion.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }
}
