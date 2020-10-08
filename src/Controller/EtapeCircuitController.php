<?php

namespace App\Controller;

use App\Entity\EtapeCircuit;
use App\Form\EtapeCircuitType;
use App\Repository\EtapeCircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etape/circuit")
 */
class EtapeCircuitController extends AbstractController
{
    /**
     * @Route("/", name="etape_circuit_index", methods={"GET"})
     */
    public function index(EtapeCircuitRepository $etapeCircuitRepository,VilleRepository $VilleRepository,CircuitRepository $CircuitRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $eta1 = new EtapeCircuit();
        $eta2 = new EtapeCircuit();
        $eta3 = new EtapeCircuit();
        $eta4 = new EtapeCircuit();
        $eta5 = new EtapeCircuit();
        $eta6 = new EtapeCircuit();
        $eta7 = new EtapeCircuit();
        $eta8 = new EtapeCircuit();
        $eta9 = new EtapeCircuit(); 

        $eta1->setDureeEtape(2)->setOrdreEtape(1)->setCircuitEtape('ete1_local')->setVilleEtape('Tunis');
        
        $eta2->setDureeEtape(5)->setOrdreEtape(2)->setCircuitEtape('ete1_local')->setVilleEtape('Sousse');
        
        $eta3->setDureeEtape(5)->setOrdreEtape(1)->setCircuitEtape('ete2_local')->setVilleEtape('Tunis');
        
        $eta4->setDureeEtape(5)->setOrdreEtape(2)->setCircuitEtape('ete2_local')->setVilleEtape('Sousse');
        
        $eta5->setDureeEtape(3)->setOrdreEtape(1)->setCircuitEtape('ete1_etranger')->setVilleEtape('Ankara'); 
        
        $eta6->setDureeEtape(5)->setOrdreEtape(2)->setCircuitEtape('ete1_etranger')->setVilleEtape('Istamboul');
        
        $eta7->setDureeEtape(3)->setOrdreEtape(1)->setCircuitEtape('ete2_etranger')->setVilleEtape('Caire');
        
        $eta8->setDureeEtape(3)->setOrdreEtape(2)->setCircuitEtape('ete2_etranger')->setVilleEtape('Alexandrie');
        
        $eta9->setDureeEtape(4)->setOrdreEtape(3)->setCircuitEtape('ete2_etranger')->setVilleEtape('Hurghada'); 


        $entityManager->persist($eta1);
        $entityManager->persist($eta2);
        $entityManager->persist($eta3);
        $entityManager->persist($eta4);
        $entityManager->persist($eta5);
        $entityManager->persist($eta6);
        $entityManager->persist($eta7);
        $entityManager->persist($eta8);
        $entityManager->persist($eta9);

        $entityManager->flush(); 


        return $this->render('etape_circuit/index.html.twig', [
            'etape_circuits' => $etapeCircuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etape_circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etapeCircuit = new EtapeCircuit();
        $form = $this->createForm(EtapeCircuitType::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etapeCircuit);
            $entityManager->flush();

            return $this->redirectToRoute('etape_circuit_index');
        }

        return $this->render('etape_circuit/new.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etape_circuit_show", methods={"GET"})
     */
    public function show(EtapeCircuit $etapeCircuit): Response
    {
        return $this->render('etape_circuit/show.html.twig', [
            'etape_circuit' => $etapeCircuit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etape_circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        $form = $this->createForm(EtapeCircuitType::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etape_circuit_index');
        }

        return $this->render('etape_circuit/edit.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etape_circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etapeCircuit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etapeCircuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etape_circuit_index');
    }
}
