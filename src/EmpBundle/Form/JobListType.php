<?php

namespace EmpBundle\Form;

use Doctrine\ORM\EntityRepository;
use EmpBundle\Entity\Employee;
use EmpBundle\Entity\JobList;
use EmpBundle\Entity\Skill;
use EmpBundle\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('openings')
            ->add('description')
            ->add('createdAt')
            ->add('skills', EntityType::class, [
             'class'=> Skill::class,
             'query_builder'=> function(EntityRepository $er){
                return $er->createQueryBuilder('s')
                    ->orderBy('s.skillTitle', 'ASC');
             }       ,
                    'choice_label'=> 'skillTitle',
                    'multiple'=> true,
                    'expanded'=>true,

                ]
            )


            ->add('jobLocation', EntityType::class, [
                'class' => 'EmpBundle\Entity\Location',
                'query_builder'=> function(EntityRepository $er){
                return $er->createQueryBuilder('l')
                    ->orderBy('l.city', 'ASC');
                },
                'choice_label'=>'city'
            ])
            ->add('jobTag', EntityType::class, [
                'class'=>Tag::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('t')
                    ->orderBy('t.tagTitle', 'ASC');

                },
                'choice_label'=>'tagTitle'
            ])
            ->add('addedBy',EntityType::class, [
                'class' => Employee::class,
               'query_builder'=> function(EntityRepository $er){
                return $er->createQueryBuilder('e')
                    ->orderBy('e.empName');
               }
               ,
                'choice_label'=>'empName'

            ] )


        ;
//        $builder->add('skills', CollectionType::class, [
//            'entry_type' => SkillType::class,
//            'entry_options' => [
//                'label' => false,
//            ],
//            'allow_add' => true
//        ] );

//            ->add('listRec');


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmpBundle\Entity\JobList'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empbundle_joblist';
    }


}
