<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:34 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EducationalController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edu/schools", name="edu_schools")
     */
    public function schoolsAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => 3,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/education/schools.html.twig', [
                'edu' => $tag

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edu/colleges", name="edu_colleges")
     */
    public function collegesAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => 2,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/education/colleges.html.twig', [
                'edu' => $tag

            ]);
        }


    }

    /**
     * @Route("/eduDash", name="edu_dash")
     * @return Response
     */
    public function recDashAction()
    {
        return $this->render('Web/education/edDash.html.twig');
    }


}