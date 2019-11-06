<?php

namespace Codeception\Module;

use Codeception\Module;
use Mail;

class EmailAssertions extends Module
{
    protected $spy;

    public function __construct()
    {
        $this->spy = new EmailSpyPlugin;
    }

    public function _before(\Codeception\TestInterface $test) {
        Mail::getSwiftMailer()->registerPlugin($this->spy);
    }

    public function _after(\Codeception\TestCase $test) {
        $this->spy->clear();
    }

    public function seeEmailWasSent()
    {
        $this->assertInstanceOf('Swift_Message', $this->spy->getMessage(), 'No Email was sent');
    }

    public function seeNoEmailWasSent()
    {
        $this->assertNull($this->spy->getMessage(), 'An Email was sent');
    }

    public function seeEmailWasSentTo(String $to)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $recievers = array_keys($this->spy->getMessage()->getTo());
        $this->assertContains($to, $recievers, 'Email was sent to ' . implode(';', $recievers));
    }

    public function seeEmailWasNotSentTo(String $to)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $recievers = array_keys($this->spy->getMessage()->getTo());
        $this->assertNotContains($to, $recievers, 'Email was not sent to ' . implode(';', $recievers));
    }

    public function seeEmailWasSentFrom(String $from)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $sender = array_keys($this->spy->getMessage()->getFrom());
        $this->assertContains($from, $sender, 'Email was sent from ' . implode(';', $sender));
    }

    public function seeEmailWasNotSentFrom(String $from)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $recievers = array_keys($this->spy->getMessage()->getFrom());
        $this->assertNotContains($from, $recievers, 'Email was not sent from ' . implode(';', $recievers));
    }

    public function seeEmailContains(String $text)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $this->assertRegexp("/$text/", $this->spy->getMessage()->getBody());
    }

    public function seeEmailContainsNot(String $text)
    {
        $this->assertNotNull($this->spy->getMessage(), 'No email was sent');
        $this->assertNotRegexp("/$text/", $this->spy->getMessage()->getBody());
    }

    public function clearEmails()
    {
        $this->spy->clear();
    }
}
