<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 17/6/18
 * Time: 10:30 PM
 */

namespace AppBundle\Controller\Api\v1;


use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ionicUserController extends FOSRestController
{
    /**
     *
     * @Rest\Post()
     *
     * @Rest\View
     * @return array
     */
    public function addUserAction(Request $request)
    {
//        $data = json_decode($jsondata, true);
        $usermanager = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $user = $usermanager->createUser();

//        $user = new User();
        $user->setUsername($data["username"]);
        $user->setEmail($data["email"]);
        $user->setMobile($data["mobile"]);
        $user->setPlainPassword($data["password"]);
        $user->setPassword($data["confirm"]);
        $user->setEnabled(true);




//        $tokenGenerator = $this->container->get('lexik_jwt_authentication.jwt_manager');


        $token =  $this->generateToken($user, 201);

        $user->setConfirmationToken($token);
        $em->persist($user);
        $em->flush();

//        $this->get('fos_user.mailer')->sendConfirmationEmailMessage($user);

        $view = View::create()
            ->setStatusCode(200)
            ->setData($user);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    protected function generateToken($user, $statusCode = 200)
    {
        // Generate the token
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($user);

    $response = array(
        'token' => $token,
        'user'  => $user // Assuming $user is serialized, else you can call getters manually
    );

    return new JsonResponse($response, $statusCode); // Return a 201 Created with the JWT.
}

//

//    public function editUserAction(Request $request, $id)
////    {
////        $usermanager = $this->get('fos_user.user_manager');
////        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
////
////        $data = $request->request->all();
////
////        $user = $usermanager->createUser();
////
//////        $user = new User();
////        $user->setUsername($data["username"]);
////        $user->setEmail($data["email"]);
////        $user->setMobile($data["mobile"]);
////        $user->setPlainPassword($data["password"]);
////        $user->setPassword($data["confirm"]);
////        $user->setEnabled(true);
////
////
////
////
////    }

}