<?php

namespace EmpBundle\Form;

use Doctrine\ORM\EntityRepository;
use EmpBundle\Entity\Employee;
use EmpBundle\Entity\RealCategory;
use EmpBundle\Entity\Reality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('realTitle')
            ->add('realAvailable')
            ->add('realDescription')
            ->add('realCreatedAt')
            ->add('realType', EntityType::class, [
                'class'=> RealCategory::class,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.realTitle', 'ASC');

                },
                'choice_label'=>'realTitle'
            ])
            ->add('realLocation', EntityType::class, [
                'class' => 'EmpBundle\Entity\Location',
                'query_builder'=> function(EntityRepository $er){
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.city', 'ASC');
                },
                'choice_label'=>'city'
            ])
            ->add('realAddedBy',EntityType::class, [
                'class' => Employee::class,
                'query_builder'=> function(EntityRepository $er){
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.empName');
                }
                ,
                'choice_label'=>'empName'

            ] );

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmpBundle\Entity\ReList'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empbundle_relist';
    }


}
