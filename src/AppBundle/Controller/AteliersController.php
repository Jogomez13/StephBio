<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ateliers;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Atelier controller.
 *
 * @Route("admin/ateliers")
 */
class AteliersController extends Controller
{
    /**
     * Lists all atelier entities.
     *
     * @Route("/", name="ateliers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ateliers = $em->getRepository('AppBundle:Ateliers')->findAll();

        return $this->render('ateliers/index.html.twig', array(
            'ateliers' => $ateliers,
        ));
    }

    /**
     * Creates a new atelier entity.
     *
     * @Route("/new", name="ateliers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $atelier = new Ateliers();
        $form = $this->createForm('AppBundle\Form\AteliersType', $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atelier);
            $em->flush($atelier);

            return $this->redirectToRoute('ateliers_show', array('id' => $atelier->getId()));
        }

        return $this->render('ateliers/new.html.twig', array(
            'atelier' => $atelier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a atelier entity.
     *
     * @Route("/{id}", name="ateliers_show")
     * @Method("GET")
     */
    public function showAction(Ateliers $atelier)
    {
        $deleteForm = $this->createDeleteForm($atelier);

        return $this->render('ateliers/show.html.twig', array(
            'atelier' => $atelier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing atelier entity.
     *
     * @Route("/{id}/edit", name="ateliers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ateliers $atelier)
    {
        $deleteForm = $this->createDeleteForm($atelier);
        $editForm = $this->createForm('AppBundle\Form\AteliersType', $atelier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ateliers_edit', array('id' => $atelier->getId()));
        }

        return $this->render('ateliers/edit.html.twig', array(
            'atelier' => $atelier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a atelier entity.
     *
     * @Route("/{id}", name="ateliers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ateliers $atelier)
    {
        $form = $this->createDeleteForm($atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atelier);
            $em->flush($atelier);
        }

        return $this->redirectToRoute('ateliers_index');
    }

    /**
     * Creates a form to delete a atelier entity.
     *
     * @param Ateliers $atelier The atelier entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Ateliers $atelier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ateliers_delete', array('id' => $atelier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
