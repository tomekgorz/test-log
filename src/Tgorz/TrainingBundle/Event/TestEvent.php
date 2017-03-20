<?php

namespace Tgorz\TrainingBundle\Event;

use Symfony\Component\EventDispatcher\Event;



class TestEvent extends Event{
    
    const TEST = 'onTest';
    
    private $text;


    public function __construct($text) {
        $this->text = $text;
    }
    
    public function getText(){
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
    }
}
