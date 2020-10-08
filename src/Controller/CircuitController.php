<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/circuit")
 */
class CircuitController extends AbstractController
{
    /**
     * @Route("/", name="circuit_index", methods={"GET"})
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $cirl = new Circuit();
        $cir2 = new Circuit();
        $cir3 = new Circuit(); 
        $cir4 = new Circuit(); 
        $cir5 = new Circuit();
        $cir6 = new Circuit(); 

        $cir1->setCodeCircuit('ete1_local')->setDesCircuit('Tunisie_ete')->setDureeCircuit(7);
        $cir2->setCodeCircuit('ete2_local')->setDesCircuit('Tunisie_ete')->setDureeCircuit('10');
        $cir3->setCodeCircuit('ete1_etranger')->setDesCircuit('Tunisie_ete')->setDureeCircuit('8'); 
        $cir4->setCodeCircuit('ete2_etranger')->setDesCircuit('Egypte_ete')->setDureeCircuit('10');
        $cir5->setCodeCircuit('ete3_etranger')->setDesCircuit('Maroc_ete')->setDureeCircuit('10');
        $cir6->setCodeCircuit('hiver1_local')->setDesCircuit('Tunisie_hiver ')->setDureeCircuit('10'); 
        
        $entityManager->persist($cir1);
        $entityManager->persist($cir2);
        $entityManager->persist($cir3);
        $entityManager->persist($cir4);
        $entityManager->persist($cir5);
        $entityManager->persist($cir6);
        
        $entityManager->flush();
        return $this->render('circuit/index.html.twig', [
            'circuits' => $circuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($circuit);
            $entityManager->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_show", methods={"GET"})
     */
    public function show(Circuit $circuit): Response
    {
        return $this->render('circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($circuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circuit_index');
    }
}
