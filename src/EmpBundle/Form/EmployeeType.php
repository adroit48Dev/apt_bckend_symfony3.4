<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 2/6/18
 * Time: 1:41 PM
 */

namespace EmpBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('empName')
            ->add('empMail')
            ->add('empPerMail')
            ->add('empMobile')
            ->add('empMobileTwo')
            ->add('empDob', BirthdayType::class, array(
                'format' => 'dd-MM-yyyy',
                'widget'=>'choice',
                'years'=> range(date('Y'), date('Y')-70)


            ))
            ->add('empDoJoin')
            ->add('empAddressFieldOne')
            ->add('empAddressFieldTwo')
            ->add('city')
            ->add('state')
            ->add('empDept', ChoiceType::class, [
                'choices' => [
                    'IT' => 'it',
                    'Financial Planning' => 'fp',
                    'Reality'=> 'reality',
                    'Medical' => 'medical'
                ]
            ])
            ->add('empStatus', ChoiceType::class, [
                'choices' => [
                    'Active' =>1,
                    'Inactive'=> 0
                ]
            ])
            ->add('empType', ChoiceType::class, [
                'choices' => [
                    'Full Time' => 'f_time',
                    'Par Time' => 'p_time',
                    'Apprenticeship' => 'appr'
                ]
            ])
            ->add('empId')
            ->add('roles', ChoiceType::class, [
                'multiple' =>true,
                'expanded' => true,
                'choices' => [
                    'Employee' => 'ROLE_EMPLOYEE',
                    'Admin' => 'ROLE_SUPER_ADMIN'
                ]
            ])
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('Submit', SubmitType::class, [
                'attr' => array('class' => 'save'),
            ]);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmpBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empbundle_employee';
    }



}