<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 7/6/18
 * Time: 1:20 PM
 */

namespace AppBundle\Form;


use AppBundle\AppBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('mobile')
            ->add('plainPassword')
            ->add('password')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));    }

    public function getBlockPrefix()
    {
       return 'app_user_registration';
    }


}