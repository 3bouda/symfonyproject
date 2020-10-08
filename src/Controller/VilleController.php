<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ville")
 */
class VilleController extends AbstractController
{
    /**
     * @Route("/", name="ville_index", methods={"GET"})
     */
    public function index(VilleRepository $villeRepository,DestinationRepository $DestinationRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $vil1 = new Ville();
        $vil2 = new Ville();
        $vil3 = new Ville();
        $vil4 = new Ville();
        $vil5 = new Ville();
        $vil6 = new Ville();
        $vil7 = new Ville();
        $vil8 = new Ville();
        $vil9 = new Ville();
        $vil10 = new Ville();
        $vil11 = new Ville();
        $vil12 = new Ville();
        $vil131 = new Ville(); 

        $vil1->setDesVille('Tunis')->setCodeVille('216_1')->setDestVille('Tunisie');
        $vil2->setDesVille('Tozeur')->setCodeVille('216_2')->setDestVille('Tunisie');
        $vil3->setDesVille('Sousse')->setCodeVille('216_3')->setDestVille('Tunisie');
        $vil4->setDesVille('CasaBlanca')->setCodeVille('212_1')->setDestVille('Maroc');
        $vil5->setDesVille ('Rabat')->setCodeVille('212_2')->setDestVille('Maroc');
        $vil6->setDesVille('Tenger')->setCodeVille('212_3')->setDestVille('Maroc');
        $vil7->setDesVille('Istamboul')->setCodeVille('20-1')->setDestVille('Turkey');
        $vil8->setDesVille('Ankara')->setCodeVille('20_2')->setDestVille('Turkey');
        $vil9->setDesVille('Caire')->setCodeVille('90_1')->setDestVille('Egypt');
        $vil10->setDesVille('Alexandrie')->setCodeVille('90_2')->setDestVille('Egypt');
        $vil11->setDesVille('Hurghada')->setCodeVille('90_3')->setDestVille('Egypt'); 
        $vil12->setDesVille('Alger')->setCodeVille('213_1')->setDestVille('Algerie');
        $vil13->setDesVille('Oran')->setCodeVille('213_2')->setDestVille('Algerie');  

        $entityManager->persist($vil1);
        $entityManager->persist($vil2);
        $entityManager->persist($vil3);
        $entityManager->persist($vil4);
        $entityManager->persist($vil5);
        $entityManager->persist($vil6);
        $entityManager->persist($vil7);
        $entityManager->persist($vil8);
        $entityManager->persist($vil9);
        $entityManager->persist($vil10);
        $entityManager->persist($vil11);
        $entityManager->persist($vil12);
        $entityManager->persist($vil13); 

        $entityManager->flush(); 

        return $this->render('ville/index.html.twig', [
            'villes' => $villeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ville_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ville);
            $entityManager->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('ville/new.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_show", methods={"GET"})
     */
    public function show(Ville $ville): Response
    {
        return $this->render('ville/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ville_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ville_index');
    }
}
