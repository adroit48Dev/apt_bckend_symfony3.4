<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:32 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\UserAppliedFinance;
use EmpBundle\Entity\FinList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancialPlanController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/loan", name="fp_loan")
     * @Method("GET")
     */
    public function loanAction(Request $request)
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 1,
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

            return $this->render('Web/fplan/loans.html.twig', [
                'plan' => $result

            ]);
        }
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/insurance", name="fp_ins")
     * @Method("GET")
     */
    public function insuranceAction(Request $request)
    {

        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 2,
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

            return $this->render('Web/fplan/insurance.html.twig', [
                'plan' => $result

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/cc", name="fp_cc")
     * @Method("GET")
     */
    public function creditCardAction(Request $request)
    {

        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 3,
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

            return $this->render('Web/fplan/cc.html.twig', [
                'plan' => $result

            ]);
        }


    }


    /**
     * @Route("/fpDash", name="fp_dash")
     * @return Response
     */
    public function recDashAction()
    {
        return $this->render('Web/fplan/fpDash.html.twig');
    }

    /**
     * @Route("/fin/apply/add/{id}", name="user_apply_fin", requirements={"id": "\d+"})
     * @ParamConverter("finList", class="EmpBundle\Entity\FinList")
     */
    public function userApplyAction(Request $request, FinList $finList)
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
        if (!$finList) {
            $this->addFlash('error', 'This post does not exists.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // Favorite exists
        $apply = $this->getDoctrine()->getRepository('AppBundle:UserAppliedFinance')->findOneBy(
            [
                'user' => $this->getUser()->getId(),
                'fPlan' => $finList->getId(),
            ]
        );

        if ($apply) {
            $this->addFlash('error', 'You have already applied.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $apply = new UserAppliedFinance();
        $apply->setUser($this->getUser());
        $apply->setFPlan($finList);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apply);
            $em->flush();

            $this->addFlash(
                "success",
                "This post has been applied successfully"
            );
        } catch (\Exception $e) {
            $this->addFlash("danger","An error occurred when saving object.");
        }

        return $this->redirect($request->server->get('HTTP_REFERER'));

    }

    /**
     * @param Request $request
     * @param FinList $finList
     * @return Response
     * @Route("/fin/view/{id}", name="view_fin_detail", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     * @ParamConverter("finList", class="EmpBundle\Entity\FinList")
     */
    public function fullViewAction(Request $request, FinList $finList)
    {
        $item = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'id' => $finList->getId(),
        ]);

        return $this->render('Web/fullFplanView.html.twig', [
            'item' => $item
        ]);

    }



}