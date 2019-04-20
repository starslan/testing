<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:09
 */

namespace App\Interfaces;


interface StrategyInterface
{
  public function  calcResult();
  public function getAttestation();
  public function getAnswer();
}