<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Editeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Editeur controller.
 *
 * @Route("editeur")
 */
class EditeurController extends Controller
{
    /**
     * Lists all editeur entities.
     *
     * @Route("/", name="editeur_index")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $editeurs = $em->getRepository('AppBundle:Editeur')->findAll();
        $delete_forms = array_map(
            function ($element) {
                return $this->createDeleteForm($element)->createView();
            }
            , $editeurs
        );

        return $this->render('editeur/index.html.twig', array(
            'editeurs' => $editeurs,
            'delete_forms' => $delete_forms
        ));
    }

    /**
     * Creates a new editeur entity.
     *
     * @Route("/new", name="editeur_new")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $editeur = new Editeur();
        $form = $this->createForm('AppBundle\Form\EditeurType', $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($editeur);
            $em->flush($editeur);

            $this->get('session')->getFlashBag()->add('success', 'Création de ' .$editeur. ' enregistré');
            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/new.html.twig', array(
            'editeur' => $editeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a editeur entity.
     *
     * @Route("/{id}", name="editeur_show")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function showAction(Editeur $editeur)
    {
        $deleteForm = $this->createDeleteForm($editeur);

        $em = $this->getDoctrine()->getManager();
        $animes = $em->getRepository('AppBundle:Anime')->getAnimeByEditor($editeur->getId());

        return $this->render('editeur/show.html.twig', array(
            'editeur' => $editeur,
            'animes'  => $animes,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing editeur entity.
     *
     * @Route("/{id}/edit", name="editeur_edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Editeur $editeur)
    {
        $deleteForm = $this->createDeleteForm($editeur);
        $editForm = $this->createForm('AppBundle\Form\EditeurType', $editeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success', 'Modification de ' .$editeur. ' enregistré');
            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/edit.html.twig', array(
            'editeur' => $editeur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a editeur entity.
     *
     * @Route("/{id}", name="editeur_delete")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Editeur $editeur)
    {
        $form = $this->createDeleteForm($editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($editeur);
            $em->flush($editeur);
            $this->get('session')->getFlashBag()->add('suppression', 'Suppression de ' .$editeur. ' enregistré');
        }

        return $this->redirectToRoute('editeur_index');
    }

    /**
     * Creates a form to delete a editeur entity.
     *
     * @param Editeur $editeur The editeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Editeur $editeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('editeur_delete', array('id' => $editeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
