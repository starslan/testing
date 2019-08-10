<?php


namespace App\Entity;

use App\Interfaces\StrategyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Attestation
{
    public function __construct(){
        $this->question = new ArrayCollection();
    }
    public  function __toString(){
        return $this->getName();
    }
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

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @ORM\Column(type="string", length=100)
     */
    private $strategyName;

    /**
     * @return mixed
     */
    public function getStrategyName()
    {
        return $this->strategyName;
    }

    /**
     * @param mixed $strategyName
     */
    public function setStrategyName($strategyName)
    {
        $this->strategyName = $strategyName;
    }

    /**
     * @ORM\OneToMany(targetEntity="AttestationExecution", mappedBy="attestation")
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

    public function removeAttestationExecution(AttestationExecution $attestationExecution)
    {
        if($this->attestationExecution->contains($attestationExecution)){
            $this->attestationExecution->removeElement($attestationExecution);
        }
        return $this;
    }

    protected $strategy;

    /**
     * @return mixed
     */
    public function getStrategy() :StrategyInterface
    {
        return $this->strategy;
    }

    /**
     * @param mixed $strategyInstance
     */
    public function setStrategy(StrategyInterface $strategyInstance): void
    {
        $this->strategy = $strategyInstance;
    }

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="attestation")
     */
    protected $question;

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }
}