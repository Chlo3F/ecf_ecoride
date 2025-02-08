<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CovoiturageController extends AbstractController
{
    #[Route('/covoiturage', name: 'covoiturage')]  
    public function covoiturage(): Response
    {
        return $this->render('covoiturage.html.twig');  
    }

}