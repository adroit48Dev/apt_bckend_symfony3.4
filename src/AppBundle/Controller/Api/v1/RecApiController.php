<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 6/6/18
 * Time: 1:24 PM
 */

namespace AppBundle\Controller\Api\v1;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
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

}