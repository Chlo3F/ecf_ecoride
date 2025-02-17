<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SaisirVoyageController extends AbstractController{

#[Route('/saisir_voyage', name: 'saisir_voyage')]
public function saisirVoyage(): Response
{
    return $this->render('saisir_voyage.html.twig');
}
}