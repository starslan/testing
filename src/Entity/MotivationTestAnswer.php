<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:43
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 *
 */
class MotivationTestAnswer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="smallint")
    */
    private $result;

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }


    /**
     * @ORM\OneToMany(targetEntity="Attestation", mappedBy="answer")
     */
    protected $attestation;

    /**
     * @return mixed
     */
    public function getAttestation()
    {
        return $this->attestation;
    }

    /**
     * @param mixed $attestation
     */
    public function addAttestation(Attestation $attestation)
    {
        $this->attestation->add($attestation);
        return $this;
    }

    public function removeAttestation(Attestation $attestation)
    {
        if($this->attestation->contains($attestation)){
            $this->attestation->removeElement($attestation);
        }
        return $this;
    }

}