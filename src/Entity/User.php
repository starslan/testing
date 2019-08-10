<?php
//src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fosUser")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->attestationExecution = new ArrayCollection();
    }


    /**
     * @ORM\OneToMany(targetEntity="AttestationExecution", mappedBy="user")
    */
    protected $attestationExecution;

    /**
     * @return mixed
     */
    public function getAttestationExecution()
    {
        return $this->attestationExecution;
    }

    public function addAttestationExecution(AttestationExecution $attestationExecution)
    {
        $this->attestationExecution->add($attestationExecution);
        return $this;
    }

    public function removeAttestation(AttestationExecution $attestationExecution)
    {
        if($this->attestationExecution->contains($attestationExecution)){
            $this->attestationExecution->removeElement($attestationExecution);
        }
        return $this;
    }
}