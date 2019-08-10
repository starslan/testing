<?php


namespace App\Strategy;


use App\Constraint\OtherTestConstraint;
use App\Entity\Attestation;
use App\Entity\AttestationExecution;
use App\Entity\OtherTestAnswer;
use App\Form\AnswerType;
use App\Form\OtherTestType;
use App\Interfaces\StrategyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OtherTestStrategy implements StrategyInterface
{

    const NAME = 'OtherTestStrategy';
    const FORM_TEMPLATE = 'Form/OtherTestForm.html.twig';

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function calcResult()
    {
        // TODO: Implement calcResult() method.
    }

    public function getName()
    {
        return self::NAME;
    }

    public function getAttestation(): Attestation
    {
        return $this->attestation;
    }

    public function setAttestation(Attestation $attestation)
    {
        $this->attestation = $attestation;
    }

    public function getForm(AttestationExecution $attestationExecution)
    {
        $answerChoices = new ArrayCollection();
        if($attestationExecution->getStatus() === AttestationExecution::STATUS_COMPLETE){
            foreach ($attestationExecution->getAnswer() as $answer){
                $answerChoices->add($answer);
            }
        }else{
            foreach($this->getAttestation()->getQuestion() as $question){
                $answer = new OtherTestAnswer();
                $answer->setQuestion($question);
                $answer->setAttestationExecution($attestationExecution);
                $answerChoices->add($answer);
            }
        }
        return $this->container->get('form.factory')->create(AnswerType::class, null, [
            'answerChoices'=>$answerChoices,
            'entryType'=> OtherTestType::class,
            'answerValid'=>new OtherTestConstraint()
        ]);
    }

    public function getView(AttestationExecution $attestationExecution)
    {
        return;
    }

    public function isComplete()
    {
        // TODO: Implement isComplete() method.
    }

    public function getFormTemplate()
    {
        return self::FORM_TEMPLATE;
    }

}