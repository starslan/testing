<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:33
 */

namespace App\Event;


use App\Entity\Attestation;
use App\Entity\MotivationTestAnswer;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;

class DynamicRelationSubscriber implements  EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
//            Events::prePersist,
        );
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
//
//        $namingStrategy = $eventArgs
//            ->getEntityManager()
//            ->getConfiguration()
//            ->getNamingStrategy();dump( $namingStrategy);

//        $this->em = $eventArgs->getEntityManager();
        if ($metadata->getName() === Attestation::class){
            $metadata->mapManyToOne([
                'targetEntity'  => MotivationTestAnswer::CLASS,
                'fieldName'     => 'answer',
                'cascade'       => ['persist'],
                'joinColumns' => [
                    [
                        'name' => 'motivation_test_answer',
                        'referencedColumnName' => 'id'
                    ]
                ],
                "inversedBy" => "attestation"
            ]);//dump($metadata);
            return;
        }
    }

    public function prePersist(LifecycleEventArgs $args){
//        dump($args);
    }
}