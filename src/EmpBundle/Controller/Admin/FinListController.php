<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\Finance;
use EmpBundle\Entity\FinList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Finlist controller.
 *
 * @Route("finlist")
 */
class FinListController extends Controller
{
    /**
     * Lists all finList entities.
     *
     * @Route("/admin/", name="finlist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $finLists = $em->getRepository('EmpBundle:FinList')->findAll();

        return $this->render('finlist/index.html.twig', array(
            'finLists' => $finLists,
        ));
    }

    /**
     * Creates a new finList entity.
     *
     * @Route("/admin/new", name="finlist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $finList = new Finlist();

        $finance = new Finance();

//        $finance->getFinAll();


        $form = $this->createForm('EmpBundle\Form\FinListType', $finList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($finList);
            $em->persist($finance);
            $em->flush();

            return $this->redirectToRoute('finlist_index', array('id' => $finList->getId()));
        }

        return $this->render('finlist/new.html.twig', array(
            'finList' => $finList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a finList entity.
     *
     * @Route("/admin/{id}", name="finlist_show")
     * @Method("GET")
     */
    public function showAction(FinList $finList)
    {
        $deleteForm = $this->createDeleteForm($finList);

        return $this->render('finlist/show.html.twig', array(
            'finList' => $finList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing finList entity.
     *
     * @Route("/admin/{id}/edit", name="finlist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FinList $finList)
    {
        $deleteForm = $this->createDeleteForm($finList);
        $editForm = $this->createForm('EmpBundle\Form\FinListType', $finList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('finlist_edit', array('id' => $finList->getId()));
        }

        return $this->render('finlist/edit.html.twig', array(
            'finList' => $finList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a finList entity.
     *
     * @Route("/admin/{id}", name="finlist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FinList $finList)
    {
        $form = $this->createDeleteForm($finList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($finList);
            $em->flush();
        }

        return $this->redirectToRoute('finlist_index');
    }

    /**
     * Creates a form to delete a finList entity.
     *
     * @param FinList $finList The finList entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(FinList $finList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('finlist_delete', array('id' => $finList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param $finList
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/fin_list", name="finance")
     * @Method("GET")
     *
     *  @ParamConverter("finList", class="EmpBundle\Entity\FinList", options={"$finList" = "findWithJoins"})
     */
    public function showAllAction(finList $finList)
    {
        $em = $this->getDoctrine()->getManager();

        $finList = $em->getRepository('EmpBundle:Finance')
            ->createQueryBuilder('fin')
            ->select('finance, fin_list, fin_category')
            ->leftJoin('fin.fin_list', 'fin_list')
            ->leftJoin('fin.fin_category', 'fin_category')
            ->getQuery()->getResult();

        return $this->render('finlist/fin_list.html.twig', [
            'list' => $finList
        ]);



    }
}
