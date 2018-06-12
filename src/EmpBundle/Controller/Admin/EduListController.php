<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\Education;
use EmpBundle\Entity\EduList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Edulist controller.
 *
 * @Route("edulist")
 */
class EduListController extends Controller
{
    /**
     * Lists all eduList entities.
     *
     * @Route("/admin/", name="edulist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eduLists = $em->getRepository('EmpBundle:EduList')->findAll();

        return $this->render('edulist/index.html.twig', array(
            'eduLists' => $eduLists,
        ));
    }

    /**
     * Creates a new eduList entity.
     *
     * @Route("/admin/new", name="edulist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eduList = new Edulist();
        $edu = new Education();
        $form = $this->createForm('EmpBundle\Form\EduListType', $eduList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eduList);
            $em->persist($edu);
            $em->flush();

            return $this->redirectToRoute('edulist_index', array('id' => $eduList->getId()));
        }

        return $this->render('edulist/new.html.twig', array(
            'eduList' => $eduList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eduList entity.
     *
     * @Route("/admin/{id}", name="edulist_show")
     * @Method("GET")
     */
    public function showAction(EduList $eduList)
    {
        $deleteForm = $this->createDeleteForm($eduList);

        return $this->render('edulist/show.html.twig', array(
            'eduList' => $eduList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing eduList entity.
     *
     * @Route("/admin/{id}/edit", name="edulist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EduList $eduList)
    {
        $deleteForm = $this->createDeleteForm($eduList);
        $editForm = $this->createForm('EmpBundle\Form\EduListType', $eduList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edulist_edit', array('id' => $eduList->getId()));
        }

        return $this->render('edulist/edit.html.twig', array(
            'eduList' => $eduList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a eduList entity.
     *
     * @Route("/admin/{id}", name="edulist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EduList $eduList)
    {
        $form = $this->createDeleteForm($eduList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eduList);
            $em->flush();
        }

        return $this->redirectToRoute('edulist_index');
    }

    /**
     * Creates a form to delete a eduList entity.
     *
     * @param EduList $eduList The eduList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EduList $eduList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('edulist_delete', array('id' => $eduList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
