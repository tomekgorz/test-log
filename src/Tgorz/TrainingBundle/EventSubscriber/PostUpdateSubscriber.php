<?php

namespace Tgorz\TrainingBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Tgorz\TrainingBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * Description of PostUpdateSubscriber
 *
 * @author Tomek
 */
class PostUpdateSubscriber implements EventSubscriber {

   public function getSubscribedEvents() 
    {
//        return array();
        return array(
            Events::preUpdate => 'onPreUpdate',
        );
    }
    
    public function onPreUpdate(\Doctrine\Common\Persistence\Event\PreUpdateEventArgs $args) {
//        $entity = $args->getObject;
        
        if ($args->getEntity() instanceof \Tgorz\TrainingBundle\Entity\Register) {
            if ($args->hasChangedField('name') && $args->getNewValue('name') == 'Tomasz Gorz') {
                $args->setNewValue('name', 'Bob');
            }
        }
    }

}
