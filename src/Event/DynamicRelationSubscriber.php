<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 14.04.2019
 * Time: 1:33
 */

namespace App\Event;


use App\Entity\Attestation;
use App\Entity\AttestationExecution;
use App\Entity\MotivationTestAnswer;
use App\Interfaces\StrategyInterface;
use App\Strategy\MotivationTestStrategy;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use function dump;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DynamicRelationSubscriber implements  EventSubscriber
{
    private $container;
    public function getSubscribedEvents()
    {
        return array(
//            Events::loadClassMetadata,
            Events::postLoad,
        );
    }
    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();

//        $namingStrategy = $eventArgs
//            ->getEntityManager()
//            ->getConfiguration()
//            ->getNamingStrategy();dump( $namingStrategy);

//        $this->em = $eventArgs->getEntityManager();
//        if ($metadata->getName() === AttestationExecution::class){
//            $metadata->mapManyToOne([
//                'targetEntity'  => MotivationTestAnswer::CLASS,
//                'fieldName'     => 'answer',
//                'cascade'       => ['persist'],
//                'joinColumns' => [
//                    [
//                        'name' => 'motivation_test_answer',
//                        'referencedColumnName' => 'id'
//                    ]
//                ],
//                "inversedBy" => "attestationExecution"
//            ]);
//            return;
//        }
    }

    public function postLoad(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if ($entity instanceof  Attestation){
            $strategyClass = 'App\Strategy\\'.$entity->getStrategyName();
            if (class_exists($strategyClass)){
                $strategy = new $strategyClass($this->container);
                $strategy->setAttestation($entity);
                $entity->setStrategy($strategy);
            }
        }

    }
}