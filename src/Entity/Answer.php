<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"motivationTest" = "MotivationTestAnswer", "otherTest"="OtherTestAnswer"})
 */
abstract class Answer
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
     * @ORM\ManyToOne(targetEntity="Question")

     */
    private $question;

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @ORM\Column(type="string")
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
     * @ORM\ManyToOne(targetEntity="AttestationExecution", inversedBy="answer", cascade={"persist"})
     */
    private $attestationExecution;

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
    public function setAttestationExecution(AttestationExecution $attestationExecution)
    {
        $this->attestationExecution = $attestationExecution;
    }


}
