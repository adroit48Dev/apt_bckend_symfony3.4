<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 2/6/18
 * Time: 8:32 PM
 */

namespace EmpBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username')
            ->add('_password', PasswordType::class);

    }

//    public function getBlockPrefix()
//    {
//        return 'emp_employee_registration';
//    }


}