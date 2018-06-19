<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 16/6/18
 * Time: 9:54 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterJobKeywordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyword', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Search by Keyword',
                ],
            ])
//            ->add('saveKeywordFilter', SubmitType::class, [
//                'label' => 'Filter Jobs',
//                'attr' => ['class' => 'btn-primary btn-block'],
//            ])
            ->setMethod('GET')
            ->setAction($options['router']->generate('search_it'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'router' => null,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }

}