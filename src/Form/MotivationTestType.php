<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 05.05.2019
 * Time: 20:42
 */

namespace App\Form;


use App\Entity\MotivationTestAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotivationTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('question', null, ['disabled'=>true, 'attr'=>['readonly'=>true]])
        ->add('result')
        ->add('additionalField')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>MotivationTestAnswer::class
        ]);
    }


}