<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:43
 */

namespace App\Entity;
use App\Interfaces\AnswerInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 *
 */
class MotivationTestAnswer extends Answer implements AnswerInterface
{
    /**
     * @ORM\Column(type="smallint")
     */
    private $additionalField;


    /**
     * @return mixed
     */
    public function getAdditionalField()
    {
        return $this->additionalField;
    }

    /**
     * @param mixed $additionalField
     */
    public function setAdditionalField($additionalField)
    {
        $this->additionalField = $additionalField;
    }
}