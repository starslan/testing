<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Table("result")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"motivationTest" = "Result"})
 */
 class Result
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", nullable=true)
    */
   protected $result;

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
    public function setResult($result): void
    {
        $this->result = $result;
    }
    /**
     * @ORM\OneToOne(targetEntity="AttestationExecution")
    */
    protected $attestationExecution;

    /**
     * @return mixed
     */
    public function getAttestationExecution()
    {
        return $this->attestationExecution;
    }

    /**
     * @param mixed $attestationExecution
     */
    public function setAttestationExecution($attestationExecution): void
    {
        $this->attestationExecution = $attestationExecution;
    }
}