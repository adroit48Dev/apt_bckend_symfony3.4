<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\RealCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Realcategory controller.
 *
 * @Route("realcategory")
 */
class RealCategoryController extends Controller
{
    /**
     * Lists all realCategory entities.
     *
     * @Route("/admin/", name="realcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $realCategories = $em->getRepository('EmpBundle:RealCategory')->findAll();

        return $this->render('realcategory/index.html.twig', array(
            'realCategories' => $realCategories,
        ));
    }

    /**
     * Creates a new realCategory entity.
     *
     * @Route("/admin/new", name="realcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $realCategory = new Realcategory();
        $form = $this->createForm('EmpBundle\Form\RealCategoryType', $realCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realCategory);
            $em->flush();

            return $this->redirectToRoute('realcategory_show', array('id' => $realCategory->getId()));
        }

        return $this->render('realcategory/new.html.twig', array(
            'realCategory' => $realCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a realCategory entity.
     *
     * @Route("/admin/{id}", name="realcategory_show")
     * @Method("GET")
     */
    public function showAction(RealCategory $realCategory)
    {
        $deleteForm = $this->createDeleteForm($realCategory);

        return $this->render('realcategory/show.html.twig', array(
            'realCategory' => $realCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing realCategory entity.
     *
     * @Route("/admin/{id}/edit", name="realcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RealCategory $realCategory)
    {
        $deleteForm = $this->createDeleteForm($realCategory);
        $editForm = $this->createForm('EmpBundle\Form\RealCategoryType', $realCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realcategory_edit', array('id' => $realCategory->getId()));
        }

        return $this->render('realcategory/edit.html.twig', array(
            'realCategory' => $realCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a realCategory entity.
     *
     * @Route("/admin/{id}", name="realcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RealCategory $realCategory)
    {
        $form = $this->createDeleteForm($realCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($realCategory);
            $em->flush();
        }

        return $this->redirectToRoute('realcategory_index');
    }

    /**
     * Creates a form to delete a realCategory entity.
     *
     * @param RealCategory $realCategory The realCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RealCategory $realCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('realcategory_delete', array('id' => $realCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
