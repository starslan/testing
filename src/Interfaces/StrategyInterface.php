<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:09
 */

namespace App\Interfaces;


use App\Entity\Attestation;
use App\Entity\AttestationExecution;

interface StrategyInterface
{
    public function calcResult();
    public function getName();
    public function getAttestation():Attestation;
    public function setAttestation(Attestation $attestation);
//  public function getAnswer();
    public function getForm(AttestationExecution $attestationExecution);
    public function getView(AttestationExecution $attestationExecution);
    public function getFormTemplate();
    public function isComplete();
}