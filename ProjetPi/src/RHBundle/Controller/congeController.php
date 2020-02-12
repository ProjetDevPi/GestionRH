<?php

namespace RHBundle\Controller;

use RHBundle\Entity\conge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Conge controller.
 *
 * @Route("conge")
 */
class congeController extends Controller
{
    /**
     * Lists all conge entities.
     *
     * @Route("/", name="conge_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conges = $em->getRepository('RHBundle:conge')->findAll();

        return $this->render('@RH/conge/index.html.twig', array(
            'conges' => $conges,
        ));
    }

    /**
     * Creates a new conge entity.
     *
     * @Route("/new", name="conge_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $conge = new Conge();
        $conge->setEtat("En attente");
        $form = $this->createForm('RHBundle\Form\congeType', $conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $conge->setUser($currentUser);
            $em->persist($conge);
            $em->flush();

            return $this->redirectToRoute('conge_new', array('id' => $conge->getId()));
        }

        return $this->render('@RH/conge/new.html.twig', array(
            'conge' => $conge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a conge entity.
     *
     * @Route("/{id}", name="conge_show")
     * @Method("GET")
     */
    public function showAction(conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);

        return $this->render('@RH/conge/show.html.twig', array(
            'conge' => $conge,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing conge entity.
     *
     * @Route("/{id}/edit", name="conge_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);
        $editForm = $this->createForm('RHBundle\Form\conge2Type', $conge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conge_index', array('id' => $conge->getId()));
        }

        return $this->render('@RH/conge/edit.html.twig', array(
            'conge' => $conge,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a conge entity.
     *
     * @Route("/{id}", name="conge_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $conge = $em->getRepository(conge::class)->find($id);

        $em->remove($conge);
        $em->flush();
        return $this->redirectToRoute('conge_index');
    }

    /**
     * Creates a form to delete a conge entity.
     *
     * @param conge $conge The conge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(conge $conge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conge_delete', array('id' => $conge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
