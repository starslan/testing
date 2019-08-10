<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 21.04.2019
 * Time: 0:40
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class AttestationExecution
{

    const STATUS_COMPLETE = 1;
    const STATUS_NOT_COMPLETE = 2;
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function __construct(Attestation $attestation)
    {

        $this->attestation = $attestation;
        $this->answer = new ArrayCollection();
    }
    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"all"}, inversedBy="attestationExecution")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Attestation", cascade={"all"}, inversedBy="attestationExecution")
     */
    private $attestation;

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
    public function setAttestation(Attestation $attestation)
    {
        $this->attestation = $attestation;
    }

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="attestationExecution")
     */
    protected $answer;

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    public function addAnswer($answer)
    {
        $this->answer->add($answer);
        return $this;
    }


    public function removeAnswer($answer)
    {
        if($this->answer->contains($answer)){
            $this->answer->removeElement($answer);
        }
        return $this;
    }

    public function getForm(){
        if(!is_null($this->getAttestation())){
            return $this->getAttestation()->getStrategy()->getForm($this);
        }
    }

    public function getView(){
        if(!is_null($this->getAttestation())){
            return $this->getAttestation()->getStrategy()->getView($this);
        }
    }

    /**
     * @ORM\Column(type="smallint")
    */
    protected $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


}