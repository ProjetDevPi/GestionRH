<?php

namespace RHBundle\Controller;

use RHBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seance controller.
 *
 * @Route("seance")
 */
class SeanceController extends Controller
{
    /**
     * Lists all seance entities.
     *
     * @Route("/", name="seance_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('RHBundle:Seance')->findAll();

        return $this->render('@RH/seance/index.html.twig', array(
            'seances' => $seances,
        ));
    }

    /**
     * Creates a new seance entity.
     *
     * @Route("/new", name="seance_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $seance = new Seance();
        $form = $this->createForm('RHBundle\Form\SeanceType', $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $seance->setUser($currentUser);
            $em->persist($seance);
            $em->flush();

            return $this->redirectToRoute('seance_show', array('id' => $seance->getId()));
        }

        return $this->render('@RH/seance/new.html.twig', array(
            'seance' => $seance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seance entity.
     *
     * @Route("/{id}", name="seance_show")
     * @Method("GET")
     */
    public function showAction(Seance $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);

        return $this->render('@RH/seance/show.html.twig', array(
            'seance' => $seance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seance entity.
     *
     * @Route("/{id}/edit", name="seance_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seance $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);
        $editForm = $this->createForm('RHBundle\Form\SeanceType', $seance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seance_edit', array('id' => $seance->getId()));
        }

        return $this->render('@RH/seance/edit.html.twig', array(
            'seance' => $seance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seance entity.
     *
     * @Route("/{id}", name="seance_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seance $seance)
    {
        $form = $this->createDeleteForm($seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seance);
            $em->flush();
        }

        return $this->redirectToRoute('seance_index');
    }

    /**
     * Creates a form to delete a seance entity.
     *
     * @param Seance $seance The seance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seance $seance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seance_delete', array('id' => $seance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function show2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('RHBundle:Seance')->findAll();
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();

        return $this->render('@RH/seance/show2.html.twig', array(
            'seances' => $seances, 'user' => $currentUser
        ));
    }
}
