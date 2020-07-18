<?php

namespace techBundle\Controller;

use techBundle\Entity\Technicien;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Technicien controller.
 *
 */
class TechnicienController extends Controller
{
    /**
     * Lists all technicien entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $techniciens = $em->getRepository('techBundle:Technicien')->findAll();

        return $this->render('technicien/index.html.twig', array(
            'techniciens' => $techniciens,
        ));
    }

    /**
     * Creates a new technicien entity.
     *
     */
    public function newAction(Request $request)
    {
        $technicien = new Technicien();
        $form = $this->createForm('techBundle\Form\TechnicienType', $technicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($technicien);
            $em->flush();

            return $this->redirectToRoute('technicien_show', array('idTech' => $technicien->getIdtech()));
        }

        return $this->render('technicien/new.html.twig', array(
            'technicien' => $technicien,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a technicien entity.
     *
     */
    public function showAction(Technicien $technicien)
    {
        $deleteForm = $this->createDeleteForm($technicien);

        return $this->render('technicien/show.html.twig', array(
            'technicien' => $technicien,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing technicien entity.
     *
     */
    public function editAction(Request $request, Technicien $technicien)
    {
        $deleteForm = $this->createDeleteForm($technicien);
        $editForm = $this->createForm('techBundle\Form\TechnicienType', $technicien);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technicien_edit', array('idTech' => $technicien->getIdtech()));
        }

        return $this->render('technicien/edit.html.twig', array(
            'technicien' => $technicien,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a technicien entity.
     *
     */
    public function deleteAction(Request $request, Technicien $technicien)
    {
        $form = $this->createDeleteForm($technicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($technicien);
            $em->flush();
        }

        return $this->redirectToRoute('technicien_index');
    }

    /**
     * Creates a form to delete a technicien entity.
     *
     * @param Technicien $technicien The technicien entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Technicien $technicien)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('technicien_delete', array('idTech' => $technicien->getIdtech())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
