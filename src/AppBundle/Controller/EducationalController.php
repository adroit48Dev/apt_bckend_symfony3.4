<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:34 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\UserAppliedEdu;
use EmpBundle\Entity\EduList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationalController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edu/schools", name="edu_schools")
     * @Method("GET")
     */
    public function schoolsAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => 3,
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

            return $this->render('Web/education/schools.html.twig', [
                'edu' => $result

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edu/colleges", name="edu_colleges")
     * @Method("GET")
     */
    public function collegesAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => 2,
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

            return $this->render('Web/education/colleges.html.twig', [
                'edu' => $result

            ]);
        }


    }


    /**
     * @Route("/edu/apply/add/{id}", name="user_apply_edu", requirements={"id": "\d+"})
     * @ParamConverter("eduList", class="EmpBundle\Entity\EduList")
     */
    public function userApplyAction(Request $request, EduList $eduList)
    {
        // User authenticated
        if (!$this->getUser()) {
            $this->addFlash(
                'error',
                'Please log in before to apply.'
            );

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Job exists
        if (!$eduList) {
            $this->addFlash('error', 'This post does not exists.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Favorite exists
        $apply = $this->getDoctrine()->getRepository('AppBundle:UserAppliedEdu')->findOneBy(
            [
                'user' => $this->getUser()->getId(),
                'education' => $eduList->getId(),
            ]
        );

        if ($apply) {
            $this->addFlash('error', 'You have already applied.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $apply = new UserAppliedEdu();
        $apply->setUser($this->getUser());
        $apply->setEducation($eduList);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apply);
            $em->flush();

            $this->addFlash(
                "success",
                "It has been applied successfully"
            );
        } catch (\Exception $e) {
            $this->addFlash("danger","An error occurred when saving object.");
        }

        return $this->redirect($request->server->get('HTTP_REFERER'));

    }

    /**
     * @Route("/eduDash", name="edu_dash")
     * @return Response
     */
    public function recDashAction()
    {
        return $this->render('Web/education/edDash.html.twig');
    }

    /**
     * @param Request $request
     * @param EduList $eduList
     * @return Response
     * @Route("edu/view/{id}", name="view_edu_detail", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     * @ParamConverter("eduList", class="EmpBundle\Entity\EduList")
     */
    public function fullViewAction(Request $request, EduList $eduList)
    {
        $item = $this->getDoctrine()->getRepository('EmpBundle:EduList')->findBy([
            'id' =>$eduList->getId(),
        ]);

        return $this->render('Web/fullEduView.html.twig', [
            'item' => $item
        ]);



    }





}