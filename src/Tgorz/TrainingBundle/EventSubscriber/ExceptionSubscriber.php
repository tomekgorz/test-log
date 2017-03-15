<?php

namespace Tgorz\TrainingBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
/**
 * Description of ExceptionSubscriber
 *
 * @author Tomek
 */
class ExceptionSubscriber implements EventSubscriberInterface 
{
    public static function getSubscribedEvents() {
        //return the subcribed events, their method and priorities
        return [
        KernelEvent::EXCEPTION => [
            ['processException',10],
            ['logException', 0],
            ['notifyException', -10],
        ]
        ];
    }
}
