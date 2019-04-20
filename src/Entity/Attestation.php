<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Attestation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Attestation constructor.
     * @param $id
     */
    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }


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
     * @ORM\ManyToOne(targetEntity="User", cascade={"all"}, inversedBy="attestation")
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

    protected $answer;

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



}