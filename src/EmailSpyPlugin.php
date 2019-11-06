<?php

namespace Codeception\Module;

use Swift_Events_EventListener;

class EmailSpyPlugin implements Swift_Events_EventListener {

    protected $message;
    protected $messages;

    public function beforeSendPerformed($event)
    {
        $this->message = $event->getMessage();
        $this->messages = $this->messages ? $this->messages->push($event->getMessage()) : collect($event->getMessage()); 
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function clear()
    {
        $this->message = null;
    }
}
