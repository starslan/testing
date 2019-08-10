<?php


namespace App\Form;


use App\Constraint\OtherTestConstraint;
use App\Entity\OtherTestAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OtherTestType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', null, ['disabled'=>true, 'attr'=>['readonly'=>true]])
            ->add('result')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>OtherTestAnswer::class,
        ]);
    }

}