<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 4/6/18
 * Time: 10:32 AM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebPageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="Homepage")
     */
    public function webIndexAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $username = $user->getUsername();

        return $this->render('Web/web.html.twig', [
            'user' => $username,
        ] );
    }

}