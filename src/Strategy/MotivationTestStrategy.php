<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 20.04.2019
 * Time: 23:43
 */

namespace App\Strategy;


use App\Constraint\MotivationTestConstraint;
use App\Entity\Attestation;
use App\Entity\AttestationExecution;
use App\Entity\MotivationTestAnswer;
use App\Form\AnswerType;
use App\Form\MotivationTestType;
use App\Interfaces\StrategyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use function dump;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MotivationTestStrategy implements StrategyInterface
{
    const NAME = 'MotivationTest';
    const FORM_TEMPLATE = 'Form/MotivationTestForm.html.twig';

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * @var Attestation $attestation
    */
    protected $attestation;

    /**
     * @return Attestation
     */
    public function getAttestation(): Attestation
    {
        return $this->attestation;
    }

    /**
     * @param Attestation $attestation
     */
    public function setAttestation(Attestation $attestation)
    {
        $this->attestation = $attestation;
    }


    public function calcResult()
    {
        // TODO: Implement calcResult() method.
    }

    public function getName()
    {
        return self::NAME;
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
                $answer = new MotivationTestAnswer();
                $answer->setQuestion($question);
                $answer->setAttestationExecution($attestationExecution);
                $answerChoices->add($answer);
            }
        }
       return $this->container->get('form.factory')->create(AnswerType::class, null, [
           'answerChoices'=>$answerChoices,
           'entryType'=> MotivationTestType::class,
           'answerValid'=>new MotivationTestConstraint()
       ]);
    }

    public function getView(AttestationExecution $attestationExecution)
    {
        $answer = $attestationExecution->getAnswer();
        return $this->getContainer()->get('templating')->render('Motivation/result.html.twig', ['answer'=>$answer]);
    }

    private $container;

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    public function isComplete(){
        return true;
    }

    public function getFormTemplate()
    {
        return self::FORM_TEMPLATE;
    }


}