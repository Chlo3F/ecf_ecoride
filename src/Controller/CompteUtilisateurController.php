<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Entity\Passager;
use App\Entity\Vehicule;
use App\Form\VehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompteUtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'compte_utilisateur')]  
public function compte_utilisateur(Request $request, EntityManagerInterface $entityManager): Response
{  
    $user = $this->getUser();
    $chauffeur = $user->getChauffeur(); 
    

    // Formulaire Véhicule
    $vehicule = new Vehicule();
    $vehiculeForm = $this->createForm(VehiculeType::class, $vehicule);
    $vehiculeForm->handleRequest($request);

    if ($vehiculeForm->isSubmitted() && $vehiculeForm->isValid()) {
        $vehicule->setChauffeur($chauffeur); // Associer le véhicule au chauffeur
        $entityManager->persist($vehicule);
        $entityManager->flush();

        $this->addFlash('success', 'Véhicule ajouté avec succès!');
        return $this->redirectToRoute('compte_utilisateur');
    }

    return $this->render('compte/index.html.twig', [
        'user' => $user,
        'vehiculeForm' => $vehiculeForm->createView(),
    ]);
}

#[Route('/utilisateur/choix-role', name: 'compte_utilisateur_role', methods: ['POST'])]
public function choixRole(Request $request, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
    $roles = $request->request->get('roles', []); // Récupère les rôles cochés

    // Vérifie si l'utilisateur a choisi "chauffeur"
    if (in_array('chauffeur', $roles)) {
        if (!$user->getChauffeur()) { 
            $chauffeur = new Chauffeur();
            $chauffeur->setUtilisateur($user);
            $entityManager->persist($chauffeur);
            $user->setChauffeur($chauffeur);
        }
    } else {
        if ($user->getChauffeur()) {
            $entityManager->remove($user->getChauffeur());
            $user->setChauffeur(null);
        }
    }

    // Vérifie si l'utilisateur a choisi "passager"
    if (in_array('passager', $roles)) {
        if (!$user->getPassager()) {
            $passager = new Passager();
            $passager->setUtilisateur($user);
            $entityManager->persist($passager);
            $user->setPassager($passager);
        }
    } else {
        if ($user->getPassager()) {
            $entityManager->remove($user->getPassager());
            $user->setPassager(null);
        }
    }

    $entityManager->flush();

    $this->addFlash('success', 'Vos préférences ont été mises à jour !');
    return $this->redirectToRoute('compte_utilisateur');
}
}