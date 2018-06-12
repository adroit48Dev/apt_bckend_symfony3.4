<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:33 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RealitiesController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/villa", name="real_villa")
     */
    public function villasAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 1,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/reality/villas.html.twig', [
                'real' => $tag

            ]);
        }



    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/flat", name="real_flat")
     */
    public function flatsAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 2,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/reality/flats.html.twig', [
                'real' => $tag

            ]);
        }



    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/real/plot", name="real_plot")
     */
    public function plotsAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:ReList')->findBy([
            'realType' => 3,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/reality/plots.html.twig', [
                'real' => $tag

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


}