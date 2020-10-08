<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Form\DestinationType;
use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/destination")
 */
class DestinationController extends AbstractController
{
    /**
     * @Route("/", name="destination_index", methods={"GET"})
     */
    public function index(DestinationRepository $destinationRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $des1 = new Destination();
        $des2 = new Destination();
        $des3 = new Destination();
        $des4 = new Destination();
        $des5 = new Destination(); 
        
        $des1->setDesDest('Tunisie')->setCodeDest('216');
        $des2->setDesDest('Algerie')->setCodeDest('213');
        $des3->setDesDest('Maroc')->setCodeDest('212');
        $des4->setDesDest('Turkey')->setCodeDest('20');
        $des5->setDesDest('Egypt')->setCodeDest('90'); 

        $entityManager->persist($des1);
        $entityManager->persist($des2);
        $entityManager->persist($des3);
        $entityManager->persist($des4);
        $entityManager->persist($des5); 
        
        $entityManager->flush();
        return $this->render('destination/index.html.twig', [
            'destinations' => $destinationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="destination_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $destination = new Destination();
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('destination_index');
        }

        return $this->render('destination/new.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destination_show", methods={"GET"})
     */
    public function show(Destination $destination): Response
    {
        return $this->render('destination/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="destination_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Destination $destination): Response
    {
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('destination_index');
        }

        return $this->render('destination/edit.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destination_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Destination $destination): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('destination_index');
    }
}
