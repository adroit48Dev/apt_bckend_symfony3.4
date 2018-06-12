<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 2/6/18
 * Time: 8:09 PM
 */

namespace EmpBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashController extends Controller
{
    /**
     * @Route("/admin/employee/dash", name="employee_dash")
     */
    public function homeAction(){

        return $this->render('Employee/dash.html.twig');

    }

}