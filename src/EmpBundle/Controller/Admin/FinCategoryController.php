<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\FinCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fincategory controller.
 *
 * @Route("fincategory")
 */
class FinCategoryController extends Controller
{
    /**
     * Lists all finCategory entities.
     *
     * @Route("/admin/", name="fincategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $finCategories = $em->getRepository('EmpBundle:FinCategory')->findAll();

        return $this->render('fincategory/index.html.twig', array(
            'finCategories' => $finCategories,
        ));
    }

    /**
     * Creates a new finCategory entity.
     *
     * @Route("/admin/new", name="fincategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $finCategory = new Fincategory();
        $form = $this->createForm('EmpBundle\Form\FinCategoryType', $finCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($finCategory);
            $em->flush();

            return $this->redirectToRoute('fincategory_index', array('id' => $finCategory->getId()));
        }

        return $this->render('fincategory/new.html.twig', array(
            'finCategory' => $finCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a finCategory entity.
     *
     * @Route("/admin/{id}", name="fincategory_show")
     * @Method("GET")
     */
    public function showAction(FinCategory $finCategory)
    {
        $deleteForm = $this->createDeleteForm($finCategory);

        return $this->render('fincategory/show.html.twig', array(
            'finCategory' => $finCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing finCategory entity.
     *
     * @Route("/admin/{id}/edit", name="fincategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FinCategory $finCategory)
    {
        $deleteForm = $this->createDeleteForm($finCategory);
        $editForm = $this->createForm('EmpBundle\Form\FinCategoryType', $finCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fincategory_edit', array('id' => $finCategory->getId()));
        }

        return $this->render('fincategory/edit.html.twig', array(
            'finCategory' => $finCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a finCategory entity.
     *
     * @Route("/admin/{id}", name="fincategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FinCategory $finCategory)
    {
        $form = $this->createDeleteForm($finCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($finCategory);
            $em->flush();
        }

        return $this->redirectToRoute('fincategory_index');
    }

    /**
     * Creates a form to delete a finCategory entity.
     *
     * @param FinCategory $finCategory The finCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FinCategory $finCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fincategory_delete', array('id' => $finCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
