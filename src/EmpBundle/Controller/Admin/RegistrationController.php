<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 2/6/18
 * Time: 5:30 PM
 */

namespace EmpBundle\Controller\Admin;


use EmpBundle\Entity\Employee;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/employee/register", name="employee_register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $emp = new Employee();

        $form= $this->createForm('EmpBundle\Form\EmployeeType', $emp);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $password = $passwordEncoder->encodePassword($emp, $emp->getPassword());
            $emp->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($emp);
            $em->flush();



            return new Response('Successfully Created', $this->renderView('Security/login.html.twig'));

        }

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('employee_register');
        }

        return $this->render('Registration/register.html.twig',
           [
               'form' => $form->createView(),
           ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/employee/{id}/edit", name="employee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employee $employee){
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('EmpBundle\Form\EmployeeType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employee_edit', array('id' => $employee->getId()));
        }

        return $this->render('Employee/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employee_edit', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}