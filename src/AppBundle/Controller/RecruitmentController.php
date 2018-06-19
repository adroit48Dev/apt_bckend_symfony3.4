<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:30 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Entity\UserApplied;
use AppBundle\Form\FilterJobKeywordType;
use EmpBundle\Entity\JobList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecruitmentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/it", name="rec_it")
     * @Method("GET")
     */
    public function itAction(Request $request)
    {


        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 1,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            $paginator = $this->get('knp_paginator');


            $result = $paginator->paginate(
                $tag,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 5));

            return $this->render('Web/recruitment/it.html.twig', [
                'list' => $result,


            ]);

        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/non", name="rec_non")
     * @Method("GET")
     */
    public function nonItAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 2,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {
            $paginator = $this->get('knp_paginator');


            $result = $paginator->paginate(
                $tag,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 5));

            return $this->render('Web/recruitment/non.html.twig', [
                'list' => $result

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/core", name="rec_core")
     * @Method("GET")
     */
    public function coreAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 3,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            $paginator = $this->get('knp_paginator');


            $result = $paginator->paginate(
                $tag,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 5));

        return $this->render('Web/recruitment/core.html.twig', [
            'list' => $result


        ]);

        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/medical", name="rec_medical")
     * @Method("GET")
     */
    public function medicalAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 4,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            $paginator = $this->get('knp_paginator');


            $result = $paginator->paginate(
                $tag,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 5));


            return $this->render('Web/recruitment/medical.html.twig', [
                'list' => $result

            ]);

        }
    }

    /**
     * @Route("/recDash", name="rec_dash")
     * @return Response
     */
    public function recDashAction()
    {
        return $this->render('Web/recruitment/recDash.html.twig');
    }


    /**
     * @Route("/rec/apply/add/{id}", name="user_apply", requirements={"id": "\d+"})
     * @ParamConverter("jobList", class="EmpBundle\Entity\JobList")
     */
    public function userApplyAction(Request $request, JobList $jobList)
    {
        // User authenticated
        if (!$this->getUser()) {
            $this->addFlash(
                'error',
                'Please log in before applying job.'
            );

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Job exists
        if (!$jobList) {
            $this->addFlash('error', 'Job does not exists.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Favorite exists
        $favorite = $this->getDoctrine()->getRepository('AppBundle:UserApplied')->findOneBy(
            [
                'user' => $this->getUser()->getId(),
                'job' => $jobList->getId(),
            ]
        );

        if ($favorite) {
            $this->addFlash('error', 'Job is already applied.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $favorite = new UserApplied();
        $favorite->setUser($this->getUser());
        $favorite->setJob($jobList);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($favorite);
            $em->flush();

            $this->addFlash(
                "success",
                "Job has been successfully applied. We'll get back to you in 48 hrs"
            );
        } catch (\Exception $e) {
            $this->addFlash("danger","An error occurred when saving object.");
        }

        return $this->redirect($request->server->get('HTTP_REFERER'));

    }

    /**
     * @param Request $request
     * @param JobList $jobList
     * @return Response
     * @Route("rec/view/{id}", name="view_detail", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     * @ParamConverter("jobList", class="EmpBundle\Entity\JobList")
     */
    public function fullViewAction(Request $request, JobList $jobList)
    {
        $item = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'id' =>$jobList->getId(),
        ]);

        return $this->render('Web/fullView.html.twig', [
            'item' => $item
        ]);



    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/search", name="search_it" )
     */

    public function searchItAction(Request $request)
    {
        $filterKeyword = $this->createForm(FilterJobKeywordType::class, [], ['router' => $this->get('router')]);
        $filterKeyword->handleRequest($request);

        $jobs = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findByFilterQuery($request);
//        $jobs = $this->get('knp_paginator')->paginate($jobs, $request->query->getInt('page', 1));


        return $this->render('Web/search.html.twig', [

            'job' => $jobs,
            'filterKeyword' => $filterKeyword->createView(),

        ]);


    }





}