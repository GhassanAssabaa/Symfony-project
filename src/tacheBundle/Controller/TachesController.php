<?php

namespace tacheBundle\Controller;

use tacheBundle\Entity\Taches;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tach controller.
 *
 */
class TachesController extends Controller
{
    /**
     * Lists all tach entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taches = $em->getRepository('tacheBundle:Taches')->findAll();

        return $this->render('taches/index.html.twig', array(
            'taches' => $taches,
        ));
    }

    /**
     * Creates a new tach entity.
     *
     */
    public function newAction(Request $request)
    {
        $tach = new Taches();
        $form = $this->createForm('tacheBundle\Form\TachesType', $tach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tach);
            $em->flush();

            return $this->redirectToRoute('taches_show', array('idTache' => $tach->getIdtache()));
        }

        return $this->render('taches/new.html.twig', array(
            'tach' => $tach,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tach entity.
     *
     */
    public function showAction(Taches $tach)
    {
        $deleteForm = $this->createDeleteForm($tach);

        return $this->render('taches/show.html.twig', array(
            'tach' => $tach,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tach entity.
     *
     */
    public function editAction(Request $request, Taches $tach)
    {
        $deleteForm = $this->createDeleteForm($tach);
        $editForm = $this->createForm('tacheBundle\Form\TachesType', $tach);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taches_edit', array('idTache' => $tach->getIdtache()));
        }

        return $this->render('taches/edit.html.twig', array(
            'tach' => $tach,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tach entity.
     *
     */
    public function deleteAction(Request $request, Taches $tach)
    {
        $form = $this->createDeleteForm($tach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tach);
            $em->flush();
        }

        return $this->redirectToRoute('taches_index');
    }

    /**
     * Creates a form to delete a tach entity.
     *
     * @param Taches $tach The tach entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Taches $tach)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taches_delete', array('idTache' => $tach->getIdtache())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
