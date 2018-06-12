<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 2/6/18
 * Time: 7:11 PM
 */

namespace EmpBundle\Controller\Admin;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/employee/login", name="security_login")
     * @param AuthenticationUtils $authenticationUtils
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils){

//        $user = $this->getUser();
//        if ($user instanceof UserInterface){
//            return $this->redirectToRoute('employee_dash');
//        }



        $authenticationUtils = $this->get('security.authentication_utils');

        $exception = $authenticationUtils->getLastAuthenticationError();

        $lastusername =  $authenticationUtils->getLastUsername();

//        $form = $this->createForm('EmpBundle\Form\LoginType', [
//            '_username' => $lastusername
//        ]);



        return $this->render('Security/login.html.twig', array(

            'error'=> $exception,

            'lastusername' => $lastusername

        ));

    }

    /**
     * @Route("/admin/employee/logout", name="logout")
     */
    public function logoutAction(){

    }



}