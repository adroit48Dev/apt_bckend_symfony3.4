<?php

namespace EmpBundle\Form;

use Doctrine\ORM\EntityRepository;
use EmpBundle\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('finTitle')
            ->add('finDescription')
            ->add('finPlan')
            ->add('finCreatedAt')
            ->add('finType',

                EntityType::class, [
                    'class' => 'EmpBundle\Entity\FinCategory',
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('s')
                            ->orderBy('s.finType', 'ASC');
                    },
                    'choice_label'=>'finType',
//                    'multiple'=> true,
//                    'expanded'=> true
                ])
            ->add('finLocation', EntityType::class, [
                'class' => 'EmpBundle\Entity\Location',
                'query_builder'=> function(EntityRepository $er){
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.city', 'ASC');
                },
                'choice_label'=>'city'
            ])
            ->add('finAddedBy',EntityType::class, [
                'class' => Employee::class,
                'query_builder'=> function(EntityRepository $er){
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.empName');
                }
                ,
                'choice_label'=>'empName'

            ] )
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmpBundle\Entity\FinList'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empbundle_finlist';
    }


}
