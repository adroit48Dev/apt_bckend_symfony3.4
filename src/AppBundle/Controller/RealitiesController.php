<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:33 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\UserApplied;
use AppBundle\Entity\UserAppliedReal;
use EmpBundle\Entity\ReList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RealitiesController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/villa", name="real_villa")
     * @Method("GET")
     */
    public function villasAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 1,
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

            return $this->render('Web/reality/villas.html.twig', [
                'real' => $result

            ]);
        }



    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/flat", name="real_flat")
     * @Method("GET")
     */
    public function flatsAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 2,
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

            return $this->render('Web/reality/flats.html.twig', [
                'real' => $result

            ]);
        }



    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/plot", name="real_plot")
     * @Method("GET")
     */
    public function plotsAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 3,
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

            return $this->render('Web/reality/plots.html.twig', [
                'real' => $result

            ]);
        }


    }

    /**
     * @Route("/realDash", name="real_dash")
     * @return Response
     */
    public function realDashAction()
    {
        return $this->render('Web/reality/realDash.html.twig');
    }

    /**
     * @Route("/real/apply/add/{id}", name="user_apply_real", requirements={"id": "\d+"})
     * @ParamConverter("reList", class="EmpBundle\Entity\ReList")
     */
    public function userApplyAction(Request $request, ReList $reList)
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
        if (!$reList) {
            $this->addFlash('error', 'This post does not exists.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Favorite exists
        $apply = $this->getDoctrine()->getRepository('AppBundle:UserAppliedReal')->findOneBy(
            [
                'user' => $this->getUser()->getId(),
                'reality' => $reList->getId(),
            ]
        );

        if ($apply) {
            $this->addFlash('error', 'You have already applied');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $apply = new UserAppliedReal();
        $apply->setUser($this->getUser());
        $apply->setReality($reList);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apply);
            $em->flush();

            $this->addFlash(
                "success",
                "It has been successfully applied."
            );
        } catch (\Exception $e) {
            $this->addFlash("danger","An error occurred when saving object.");
        }

        return $this->redirect($request->server->get('HTTP_REFERER'));

    }

    /**
     * @param Request $request
     * @param ReList $reList
     * @return Response
     * @Route("real/view/{id}", name="view_real_detail", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     * @ParamConverter("reList", class="EmpBundle\Entity\ReList")
     */
    public function fullViewAction(Request $request, ReList $reList)
    {
        $item = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'id' => $reList->getId(),
        ]);

        return $this->render('Web/fullRealView.html.twig', [
            'land' => $item
        ]);
    }






}