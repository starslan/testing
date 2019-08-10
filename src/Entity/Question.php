<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{

    public function __toString(){
        return $this->getTitle();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Attestation", inversedBy="question")
     * @ORM\JoinColumn(name="attestation_id", referencedColumnName="id", nullable=false)
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
    public function setAttestation($attestation)
    {
        $this->attestation = $attestation;
    }
}
