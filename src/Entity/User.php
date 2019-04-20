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
        $this->attestation = new ArrayCollection();
    }


    /**
     * @ORM\OneToMany(targetEntity="Attestation", mappedBy="user")
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