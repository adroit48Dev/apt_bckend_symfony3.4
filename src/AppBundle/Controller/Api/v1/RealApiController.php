<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 14/6/18
 * Time: 7:14 PM
 */

namespace AppBundle\Controller\Api\v1;


use AppBundle\Entity\UserAppliedReal;
use EmpBundle\Entity\ReList;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RealApiController extends FOSRestController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Rest\Get("/api/v1/villa/get.{_format}")
     */
    public function showVillaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villa = $em->getRepository('EmpBundle:ReList')->findBy([
            'realType' => [1]
        ]);
        $statuscode = 200;

        $view = $this->view($villa, $statuscode    );

        return $this->handleView($view);

    }


    /**
     * @Rest\Get("/api/v1/flat/get.{_format}")
     *
     * @Rest\View()
     */
    public function flatAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flat = $em->getRepository('EmpBundle:ReList')->findBy([
            'realType' => [2]
        ]);
        $statuscode = 200;

        $view = $this->view($flat, $statuscode    );

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/v1/plot/get.{_format}")
     *
     * @Rest\View()
     */
    public function plotAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plot = $em->getRepository('EmpBundle:ReList')->findBy([
            'realType' => [3]
        ]);
        $statuscode = 200;

        $view = $this->view($plot, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     *
     * @Rest\Get("api/v1/real/{id}")
     * @Rest\View()
     *
     */
    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $real = $em->getRepository('EmpBundle:ReList')->find($id);

        $statuscode = 200;

        $view = $this->view($real, $statuscode    );

        return $this->handleView($view);
    }

    /**
     *
     * @param ReList $reList
     * @Rest\Post("/api/v1/real/apply/{id}")
     * @Rest\View()
     *
     *
     */
    public function applyAction(Request $request, ReList $reList)
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
                'job' => $reList->getId(),
            ]
        );

//        $favorite->submit($request->request->get('job'), true);

        if ($favorite ===null){

            return new JsonResponse('This is not available');
        }

        $favorite = new UserAppliedReal();
        $favorite->setUser($this->getUser());
        $favorite->setReality($reList);

        $em = $this->getDoctrine()->getManager();
        $em->persist($favorite);
        $em->flush();

        $statuscode = 200;

        $view = $this->view($favorite, $statuscode  );

        return $this->handleView($view);


    }

}