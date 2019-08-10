<?php


namespace App\Constraint;


use Symfony\Component\Validator\Constraint;

class OtherTestConstraint extends Constraint
{
   public  $message = '{{value}} не находится в диапазоне от 5 до 10';

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}