<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:32 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FinancialPlanController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/loan", name="fp_loan")
     */
    public function loanAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 1,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/fplan/loans.html.twig', [
                'plan' => $tag

            ]);
        }
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/insurance", name="fp_ins")
     */
    public function insuranceAction()
    {

        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 2,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/fplan/insurance.html.twig', [
                'plan' => $tag

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/fp/cc", name="fp_cc")
     */
    public function creditCardAction()
    {

        $tag = $this->getDoctrine()->getRepository('EmpBundle:FinList')->findBy([
            'finType' => 3,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/fplan/cc.html.twig', [
                'plan' => $tag

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




}