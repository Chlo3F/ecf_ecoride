<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CompteUtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'compte_utilisateur')]  
    public function compte_utilsateur(): Response
    {
        return $this->render('compte_utilisateur.html.twig');  
    }

}