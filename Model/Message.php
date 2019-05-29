<?php
/**
 * Created by PhpStorm.
 * User: jgimenez
 * Date: 28/05/2019
 * Time: 16:27
 */

namespace Challenge\Model;

use \SplObserver;

class Message implements \SplSubject
{

    const SEND_EMAIL_EVENT = 'send_email_event';
    const SEND_EMAIL_LIST_EVENT = 'send_email_list_event';
    /**
     * @var string
     */
    protected $from;
    /**
     * @var string
     */
    protected $to;
    /**
     * @var string
     */
    protected $subject;
    /**
     * @var string
     */
    protected $body;

    /**
     * @var array
     */
    protected $linkedList = [];

    /**
     * @var \SplObserver[]
     */
    protected $observers = [];

    /**
     * @var string
     */
    protected $event;

    /**
     * Message constructor.
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     */
    public function __construct(string $from, string $to, string $subject, string $body)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }


    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $observerKey = spl_object_hash($observer);
        $this->observers[$observerKey] = $observer;
        $this->linkedList[$observerKey] = $observer->getPriority();
        arsort($this->linkedList);
    }


    /**
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $observerKey = spl_object_hash($observer);
        unset($this->observers[$observerKey]);
        unset($this->linkedList[$observerKey]);
    }

    /**
     * Notificator
     */
    public function notify()
    {
        foreach ($this->linkedList as $key => $value) {
            $this->observers[$key]->update($this);
        }
    }

    public function dispatch($event)
    {
        $this->setEvent($event)->notify();
        return $this;
    }

    /**
     * @param string $event
     * @return Message
     */
    public function setEvent(string $event): Message
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @param string $from
     * @return Message
     */
    public function setFrom(string $from): Message
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $to
     * @return Message
     */
    public function setTo(string $to): Message
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param string $subject
     * @return Message
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }


}