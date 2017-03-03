<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Studio controller.
 *
 * @Route("studio")
 */
class StudioController extends Controller
{
    /**
     * Lists all studio entities.
     *
     * @Route("/", name="studio_index")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studios = $em->getRepository('AppBundle:Studio')->getAll();
        $delete_forms = array_map(
            function ($element) {
                return $this->createDeleteForm($element)->createView();
            }
            , $studios
        );

        return $this->render('studio/index.html.twig', array(
            'studios' => $studios,
            'delete_forms' => $delete_forms
        ));
    }

    /**
     * Creates a new studio entity.
     *
     * @Route("/new", name="studio_new")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $studio = new Studio();
        $form = $this->createForm('AppBundle\Form\StudioType', $studio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($studio);
            $em->flush($studio);

            $this->get('session')->getFlashBag()->add('success', 'Création de ' .$studio. ' enregistré');
            return $this->redirectToRoute('studio_index');
        }

        return $this->render('studio/new.html.twig', array(
            'studio' => $studio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a studio entity.
     *
     * @Route("/{id}", name="studio_show")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function showAction(Studio $studio)
    {
        $deleteForm = $this->createDeleteForm($studio);

        return $this->render('studio/show.html.twig', array(
            'studio' => $studio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing studio entity.
     *
     * @Route("/{id}/edit", name="studio_edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Studio $studio)
    {
        $deleteForm = $this->createDeleteForm($studio);
        $editForm = $this->createForm('AppBundle\Form\StudioType', $studio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success', 'Modification de ' .$studio. ' enregistré');
            return $this->redirectToRoute('studio_index');
        }

        return $this->render('studio/edit.html.twig', array(
            'studio' => $studio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a studio entity.
     *
     * @Route("/{id}", name="studio_delete")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Studio $studio)
    {
        $form = $this->createDeleteForm($studio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studio);
            $em->flush($studio);
            $this->get('session')->getFlashBag()->add('suppression', 'Suppression de ' .$studio. ' enregistré');
        }

        return $this->redirectToRoute('studio_index');
    }

    /**
     * Creates a form to delete a studio entity.
     *
     * @param Studio $studio The studio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Studio $studio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('studio_delete', array('id' => $studio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
