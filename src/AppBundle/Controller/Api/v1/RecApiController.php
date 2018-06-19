<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 6/6/18
 * Time: 1:24 PM
 */

namespace AppBundle\Controller\Api\v1;


use AppBundle\Entity\UserApplied;
use EmpBundle\Entity\JobList;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecApiController extends FOSRestController
{
    /**
     * @Rest\Get("/api/v1/it/get.{_format}")
     *
     * @Rest\View()
     */
    public function itAction()
    {
        $em = $this->getDoctrine()->getManager();

        $it = $em->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => [1]
        ]);
        $statuscode = 200;

        $view = $this->view($it, $statuscode    );

        return $this->handleView($view);
    }


    /**
     * @Rest\Get("/api/v1/non/get.{_format}")
     *
     * @Rest\View()
     */
    public function nonItAction()
    {
        $em = $this->getDoctrine()->getManager();

        $non = $em->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => [2]
        ]);
        $statuscode = 200;

        $view = $this->view($non, $statuscode    );

        return $this->handleView($view);
    }


    /**
     * @Rest\Get("/api/v1/core/get.{_format}")
     *
     * @Rest\View()
     */
    public function coreAction()
    {
        $em = $this->getDoctrine()->getManager();

        $core = $em->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => [3]
        ]);
        $statuscode = 200;

        $view = $this->view($core, $statuscode    );

        return $this->handleView($view);
    }


    /**
     * @Rest\Get("/api/v1/medical/get.{_format}")
     *
     * @Rest\View()
     */
    public function medicalAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medical = $em->getRepository('EmpBundle:JobList')->findBy([
            'jobTag' => [4]
        ]);
        $statuscode = 200;

        $view = $this->view($medical, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     *
     * @Rest\Get("api/v1/job/{id}")
     * @Rest\View()
     *
     */
    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $it = $em->getRepository('EmpBundle:JobList')->find($id);

        $statuscode = 200;

        $view = $this->view($it, $statuscode    );

        return $this->handleView($view);
    }

    public function cgetAction(){
        $em = $this->getDoctrine()->getManager();

        $ent = $em->getRepository('EmpBundle:JobList')->findAll();
    }

    /**
     *
     * @param JobList $jobList
     * @Rest\Post("/api/v1/it/apply/{id}")
     * @Rest\View()
     *
     *
     */
    public function applyAction(Request $request, JobList $jobList)
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
                'job' => $jobList->getId(),
            ]
        );

//        $favorite->submit($request->request->get('job'), true);

        if ($favorite ===null){

            return new JsonResponse('This is not available');
        }

        $favorite = new UserApplied();
        $favorite->setUser($this->getUser());
        $favorite->setJob($jobList);

        $em = $this->getDoctrine()->getManager();
        $em->persist($favorite);
        $em->flush();

        $statuscode = 200;

        $view = $this->view($favorite, $statuscode  );

        return $this->handleView($view);


    }

}