<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 14/6/18
 * Time: 4:58 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{

    /**
     * @Route("/user/profile/show", name="user_profile")
     * @Method("GET")
     */
    public function showAction()
    {
        $profile = $this->getDoctrine()->getRepository('AppBundle:Profile')->findAll();


        return $this->render('Web/profile.html.twig', [
            'profile' => $profile,
        ]);

    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/profile/add", name="user_profile_add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $profile = new Profile();

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();


        $form = $this->createForm('AppBundle\Form\ProfileType', $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
        }

        return $this->render('Web/profile.html.twig', [
            'user' => $user,
            'form' =>$form->createView(),

        ]);


    }
    

}