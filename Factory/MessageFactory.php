<?php

namespace Challenge\Factory;

use Challenge\Model\Message;
use Challenge\Observer\AnotherPartOfSystem;
use Challenge\Observer\EmailSender;

class MessageFactory
{
    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return Message
     */
    public function create(string $from, string $to, string $subject, string $body)
    {
        /** creando Email y seteando observadores **/
        $message = new Message($from, $to, $subject, $body);
        $firstObserver = new EmailSender();
        $firstObserver->setPriority(1);
        $message->attach($firstObserver);
        $secondObserver = new AnotherPartOfSystem();
        $secondObserver->setPriority(2);
        $message->attach($secondObserver);
        return $message;
    }
}