<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 14/6/18
 * Time: 7:15 PM
 */

namespace AppBundle\Controller\Api\v1;


use AppBundle\Entity\UserAppliedEdu;
use EmpBundle\Entity\EduList;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class EducationApiController extends FOSRestController
{

    /**
     * @Rest\Get("/api/v1/school/get.{_format}")
     *
     * @Rest\View()
     */
    public function schoolAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loan = $em->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => [3]
        ]);
        $statuscode = 200;

        $view = $this->view($loan, $statuscode    );

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/v1/college/get.{_format}")
     *
     * @Rest\View()
     */
    public function collegeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coll = $em->getRepository('EmpBundle:EduList')->findBy([
            'edCategory' => [2]
        ]);
        $statuscode = 200;

        $view = $this->view($coll, $statuscode    );

        return $this->handleView($view);
    }


    /**
     *
     *
     * @Rest\Get("api/v1/edu/{id}")
     * @Rest\View()
     *
     */
    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $edu = $em->getRepository('EmpBundle:EduList')->find($id);

        $statuscode = 200;

        $view = $this->view($edu, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     * @param EduList $eduList
     * @Rest\Post("/api/v1/edu/apply/{id}")
     * @Rest\View()
     *
     *
     */
    public function applyAction(Request $request, EduList $eduList)
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
                'job' => $eduList->getId(),
            ]
        );

//        $favorite->submit($request->request->get('job'), true);

        if ($favorite ===null){

            return new JsonResponse('This is not available');
        }

        $favorite = new UserAppliedEdu();
        $favorite->setUser($this->getUser());
        $favorite->setEducation($eduList);

        $em = $this->getDoctrine()->getManager();
        $em->persist($favorite);
        $em->flush();

        $statuscode = 200;

        $view = $this->view($favorite, $statuscode  );

        return $this->handleView($view);


    }

}