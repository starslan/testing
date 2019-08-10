<?php


namespace App\Constraint;


use App\Entity\MotivationTestAnswer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MotivationTestConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $resultSum=0;
        $additionalSum=0;
        foreach ($value as $item){
            /**@var MotivationTestAnswer $item */
            $resultSum += (int)$item->getResult();
            $additionalSum += (int)$item->getAdditionalField();
        }
        if($resultSum > 40 or $additionalSum > 30){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }

}