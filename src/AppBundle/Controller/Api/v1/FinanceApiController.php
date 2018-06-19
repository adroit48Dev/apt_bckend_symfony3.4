<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 14/6/18
 * Time: 7:14 PM
 */

namespace AppBundle\Controller\Api\v1;


use AppBundle\Entity\UserAppliedFinance;
use EmpBundle\Entity\FinList;
use EmpBundle\Entity\JobList;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\NelmioApiDocBundle;


class FinanceApiController extends FOSRestController
{

    /**
     * @Rest\Get("/api/v1/loan/get.{_format}")
     *
     * @Rest\View()
     */
    public function loanAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loan = $em->getRepository('EmpBundle:FinList')->findBy([
            'finType' => [1]
        ]);
        $statuscode = 200;

        $view = $this->view($loan, $statuscode    );

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/v1/insurance/get.{_format}")
     *
     * @Rest\View()
     */
    public function insAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ins = $em->getRepository('EmpBundle:FinList')->findBy([
            'finType' => [2]
        ]);
        $statuscode = 200;

        $view = $this->view($ins, $statuscode    );

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/v1/credit/get.{_format}")
     *
     * @Rest\View()
     */
    public function plotAction()
    {
        $em = $this->getDoctrine()->getManager();

        $card = $em->getRepository('EmpBundle:FinList')->findBy([
            'finType' => [3]
        ]);
        $statuscode = 200;

        $view = $this->view($card, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     *
     * @Rest\Get("api/v1/fplan/{id}")
     * @Rest\View()
     *
     */
    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $plan = $em->getRepository('EmpBundle:FinList')->find($id);

        $statuscode = 200;

        $view = $this->view($plan, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     * @param FinList $finList
     * @Rest\Post("/api/v1/fplan/apply/{id}")
     * @Rest\View()
     *
     *
     */
    public function applyAction(Request $request, FinList $finList)
    {


        if (!$this->getUser()) {
            $this->addFlash(
                'error',
                'Please log in before applying job.'
            );
        }

        $favorite = $this->getDoctrine()->getRepository('AppBundle:UserApplied')->findOneBy(
            [
                'user' => $this->getUser()->getId(),
                'job' => $finList->getId(),
            ]
        );

//        $favorite->submit($request->request->get('job'), true);

        if ($favorite ===null){

            return new JsonResponse('This is not available');
        }

        $favorite = new UserAppliedFinance();
        $favorite->setUser($this->getUser());
        $favorite->setFPlan($finList);

        $em = $this->getDoctrine()->getManager();
        $em->persist($favorite);
        $em->flush();

        $statuscode = 200;

        $view = $this->view($favorite, $statuscode  );

        return $this->handleView($view);


    }


}