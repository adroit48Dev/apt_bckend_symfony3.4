<?php

namespace EmpBundle\Form;

use Doctrine\ORM\EntityRepository;
use EmpBundle\Entity\EdCategory;
use EmpBundle\Entity\EduList;
use EmpBundle\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EduListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('edTitle')
            ->add('edDescription')
            ->add('edCreatedAt')
            ->add('edCategory', EntityType::class, [
                'class'=>EdCategory::class,
                'query_builder'=>function(EntityRepository $er){
                return $er->createQueryBuilder('c')
                    ->orderBy('c.eduTitle', 'ASC');
                },
                'choice_label' =>'eduTitle'
            ])
            ->add('edLocation', EntityType::class, [
                'class' => 'EmpBundle\Entity\Location',
                'query_builder'=> function(EntityRepository $er){
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.city', 'ASC');
                },
                'choice_label'=>'city'
            ])
            ->add('eduAddedBy',EntityType::class, [
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
            'data_class' => 'EmpBundle\Entity\EduList'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empbundle_edulist';
    }


}
