<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\EdCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Edcategory controller.
 *
 * @Route("edcategory")
 */
class EdCategoryController extends Controller
{
    /**
     * Lists all edCategory entities.
     *
     * @Route("/admin/", name="edcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $edCategories = $em->getRepository('EmpBundle:EdCategory')->findAll();

        return $this->render('edcategory/index.html.twig', array(
            'edCategories' => $edCategories,
        ));
    }

    /**
     * Creates a new edCategory entity.
     *
     * @Route("/admin/new", name="edcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $edCategory = new Edcategory();
        $form = $this->createForm('EmpBundle\Form\EdCategoryType', $edCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($edCategory);
            $em->flush();

            return $this->redirectToRoute('edcategory_show', array('id' => $edCategory->getId()));
        }

        return $this->render('edcategory/new.html.twig', array(
            'edCategory' => $edCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a edCategory entity.
     *
     * @Route("/admin/{id}", name="edcategory_show")
     * @Method("GET")
     */
    public function showAction(EdCategory $edCategory)
    {
        $deleteForm = $this->createDeleteForm($edCategory);

        return $this->render('edcategory/show.html.twig', array(
            'edCategory' => $edCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing edCategory entity.
     *
     * @Route("/admin/{id}/edit", name="edcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EdCategory $edCategory)
    {
        $deleteForm = $this->createDeleteForm($edCategory);
        $editForm = $this->createForm('EmpBundle\Form\EdCategoryType', $edCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edcategory_edit', array('id' => $edCategory->getId()));
        }

        return $this->render('edcategory/edit.html.twig', array(
            'edCategory' => $edCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a edCategory entity.
     *
     * @Route("/admin/{id}", name="edcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EdCategory $edCategory)
    {
        $form = $this->createDeleteForm($edCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($edCategory);
            $em->flush();
        }

        return $this->redirectToRoute('edcategory_index');
    }

    /**
     * Creates a form to delete a edCategory entity.
     *
     * @param EdCategory $edCategory The edCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EdCategory $edCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('edcategory_delete', array('id' => $edCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
