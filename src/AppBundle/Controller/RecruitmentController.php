<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 12:30 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use EmpBundle\Entity\JobList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RecruitmentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/it", name="rec_it")
     */
    public function itAction()
    {


        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 1,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/recruitment/it.html.twig', [
                'list' => $tag

            ]);

        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/non", name="rec_non")
     */
    public function nonItAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 2,
        ]);
        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

            return $this->render('Web/recruitment/non.html.twig', [
                'list' => $tag

            ]);
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/core", name="rec_core")
     */
    public function coreAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 3,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {

        return $this->render('Web/recruitment/core.html.twig', [
            'list' => $tag


        ]);

        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rec/medical", name="rec_medical")
     */
    public function medicalAction()
    {
        $tag = $this->getDoctrine()->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => 4,
        ]);

        if (empty($tag)){

            return $this->render('Web/alert.html.twig');
        }
        else {


            return $this->render('Web/recruitment/medical.html.twig', [
                'list' => $tag

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




    public function userApplyAction()
    {
//        $request = $this->get('request');
//        $jobId=$request->request->get('jobId');
//        if($jobId != NULL)
//        {
//            //MAKE NEW FAVORITE AND ADD TO DATABASE LINKED WITH ITEM
//            $apply = new JobList();
//            $apply->setjobId($this->getUser());
//
//            //LINK FAVORITE ID WITH USER ID IN JOINCOLUMN
//            $userId = 6;
//            $em = $this->getDoctrine()->getEntityManager();
//
//            $user = $em->getRepository('GeoCityTroopersBundle:Users')->find($userId);
//
//            $favorite->addUser($user);
//            $em->persist($favorite);
//
//            //I TRIED THIS TOO, BUT IT FAILED
//            /*$user->addFavorite($favorite);
//            $em->persist($user);*/
//
//            $em->flush();

        

    }



}