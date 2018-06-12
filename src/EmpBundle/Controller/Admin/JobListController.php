<?php

namespace EmpBundle\Controller\Admin;

use EmpBundle\Entity\JobList;
use EmpBundle\Entity\Location;
use EmpBundle\Entity\Recruitment;
use EmpBundle\Entity\Skill;
use EmpBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Joblist controller.
 *
 * @Route("joblist")
 */
class JobListController extends Controller
{
    /**
     * Lists all jobList entities.
     *
     * @Route("/admin/", name="joblist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobLists = $em->getRepository('EmpBundle:JobList')->findAll();

        return $this->render('joblist/index.html.twig', array(
            'jobLists' => $jobLists,
        ));
    }

    /**
     * Creates a new jobList entity.
     *
     * @Route("/admin/new", name="joblist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jobList = new Joblist();
        $skills = new Skill();
//        $loc = new Location();
        $rec = new Recruitment();
        $form = $this->createForm('EmpBundle\Form\JobListType', $jobList);
        $form1 = $this->createForm('EmpBundle\Form\SkillType', $skills);
        $form->handleRequest($request);
        $form1->handleRequest($request);
        if ($form1->isSubmitted()&& $form1->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($skills);
            $em->flush();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($jobList);
            $em->persist($rec);

//            $em->persist($loc);
            $em->flush();

            return $this->redirectToRoute('joblist_index', array('id' => $jobList->getId()));
        }

        return $this->render('joblist/new.html.twig', array(
            'jobList' => $jobList,
            'skill'=>$skills,
            'form' => $form->createView(),
            'form1' => $form1->createView(),
        ));
    }

    /**
     * Finds and displays a jobList entity.
     *
     * @Route("/admin/{id}", name="joblist_show")
     * @Method("GET")
     */
    public function showAction(JobList $jobList)
    {
        $deleteForm = $this->createDeleteForm($jobList);

        return $this->render('joblist/show.html.twig', array(
            'jobList' => $jobList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jobList entity.
     *
     * @Route("/admin/{id}/edit", name="joblist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JobList $jobList)
    {
        $deleteForm = $this->createDeleteForm($jobList);
        $editForm = $this->createForm('EmpBundle\Form\JobListType', $jobList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('joblist_edit', array('id' => $jobList->getId()));
        }

        return $this->render('joblist/edit.html.twig', array(
            'jobList' => $jobList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jobList entity.
     *
     * @Route("/admin/{id}", name="joblist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JobList $jobList)
    {
        $form = $this->createDeleteForm($jobList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobList);
            $em->flush();
        }

        return $this->redirectToRoute('joblist_index');
    }

    /**
     * Creates a form to delete a jobList entity.
     *
     * @param JobList $jobList The jobList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JobList $jobList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('joblist_delete', array('id' => $jobList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
