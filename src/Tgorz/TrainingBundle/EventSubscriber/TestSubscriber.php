<?php

namespace Tgorz\TrainingBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tgorz\TrainingBundle\Event\TestEvent;
/**
 * Description of TestSubscrier
 *
 * @author Tomek
 */
class TestSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents() {
        return [
        TestEvent::TEST => 'onTest'
        ];
    }
    
    public function onTest(TestEvent $test) {
        $text = 'test';
        $test->setText($text);
    }

}
