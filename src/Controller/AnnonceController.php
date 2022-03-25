<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce_index')]
    public function index(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'Dealgames - Déposer une annonce',
        ]);
    }
    #[Route('/annonce/create', name: 'app_annonce_create')]
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $annonce = new Annonce;
        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManagerInterface->persist($annonce);
            $entityManagerInterface->flush();

            $this->addFlash('success' , 'Album Annonce enregistré !');
        }
        return $this->render('annonce/create.html.twig', [
            'formvue' => $form->createView(),
        ]);
    }

    #[Route('/annonce/edit/{id}', name: 'app_annonce_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManagerInterface, Annonce $annonce): Response
    {

        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManagerInterface->persist($annonce);
            $entityManagerInterface->flush();

            $this->addFlash('success' , 'Annonce enregistré !');
        }
        return $this->render('annonce/create.html.twig', [
            'formvue' => $form->createView(),
        ]);
    }

    #[Route('/annonce/delete/{id}', name: 'app_annonce_dilete')]
    public function delete(EntityManagerInterface $entityManagerInterface, Annonce $annonce): Response
    {
        
       
            $entityManagerInterface->persist($annonce);
            $entityManagerInterface->flush();

            $this->addFlash('success' , 'Album Annonce enregistré !');
        
        return $this->render('annonce/create.html.twig'
         
        );
    }
   
}
