<?php


namespace App\Constraint;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OtherTestConstraintValidator extends  ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        $this->context->setNode($this->context->getValue(), $this->context->getObject(), $this->context->getMetadata(), '');
        foreach ($value as $key => $item){
            if($item->getResult() < 5 or $item->getResult() > 10){
                $this->context->buildViolation($constraint->getMessage())
                    ->setParameter('{{value}}', $this->formatValue($item->getResult()))
                    ->atPath('children[answer].children['.$key.'].children[result]')
                    ->addViolation();
            }
        }

    }
}