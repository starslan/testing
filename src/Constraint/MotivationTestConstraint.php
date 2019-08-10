<?php


namespace App\Constraint;


use Symfony\Component\Validator\Constraint;

class MotivationTestConstraint extends Constraint
{
    public $message = 'Сумма результата не должна превышать 40 сумма доп.полей не должна превышать 30';

}