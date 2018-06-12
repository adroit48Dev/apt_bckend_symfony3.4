<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\Reality;
use EmpBundle\Entity\ReList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Relist controller.
 *
 * @Route("relist")
 */
class ReListController extends Controller
{
    /**
     * Lists all reList entities.
     *
     * @Route("/admin/", name="relist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reLists = $em->getRepository('EmpBundle:ReList')->findAll();

        return $this->render('relist/index.html.twig', array(
            'reLists' => $reLists,
        ));
    }

    /**
     * Creates a new reList entity.
     *
     * @Route("/admin/new", name="relist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reList = new Relist();
        $real = new Reality();
        $form = $this->createForm('EmpBundle\Form\ReListType', $reList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reList);
            $em->persist($real);
            $em->flush();

            return $this->redirectToRoute('relist_show', array('id' => $reList->getId()));
        }

        return $this->render('relist/new.html.twig', array(
            'reList' => $reList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reList entity.
     *
     * @Route("/admin/{id}", name="relist_show")
     * @Method("GET")
     */
    public function showAction(ReList $reList)
    {
        $deleteForm = $this->createDeleteForm($reList);

        return $this->render('relist/show.html.twig', array(
            'reList' => $reList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reList entity.
     *
     * @Route("/admin/{id}/edit", name="relist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReList $reList)
    {
        $deleteForm = $this->createDeleteForm($reList);
        $editForm = $this->createForm('EmpBundle\Form\ReListType', $reList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('relist_edit', array('id' => $reList->getId()));
        }

        return $this->render('relist/edit.html.twig', array(
            'reList' => $reList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reList entity.
     *
     * @Route("/admin/{id}", name="relist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReList $reList)
    {
        $form = $this->createDeleteForm($reList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reList);
            $em->flush();
        }

        return $this->redirectToRoute('relist_index');
    }

    /**
     * Creates a form to delete a reList entity.
     *
     * @param ReList $reList The reList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReList $reList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('relist_delete', array('id' => $reList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
