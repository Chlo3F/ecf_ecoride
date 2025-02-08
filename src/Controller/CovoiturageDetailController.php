<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CovoiturageDetailController extends AbstractController
{
    #[Route('/detail', name: 'detail')]  
    public function detail(): Response
    {
        return $this->render('covoiturage_detail.html.twig');  
    }

}