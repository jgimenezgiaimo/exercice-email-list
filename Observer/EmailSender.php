<?php
/**
 * Copyright (C) 2019
 *
 * This file is part of Test.
 *
 * Test/Test is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * @author Juan Pablo Gimenez Giaimo <jgimenezgiaimo@gmail.com>
 */

namespace Challenge\Observer;

use \SplSubject;
use Challenge\Model\Message;
use Challenge\Lib\Mailer;

class EmailSender implements \SplObserver
{
    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * EmailSender constructor.
     * The parameters are resolved with dependency injection from framework XX
     * @param Mailer $mailer
     */
    public function __construct(
        Mailer $mailer
    ) {

        $this->mailer = $mailer;
    }

    /**
     * @var int
     */
    protected $priority;

    /**
     * @param SplSubject $message
     * @return EmailSender
     */
    public function update(SplSubject $message)
    {
        /** @var $message Message * */
        if ($message->getEvent() == Message::SEND_EMAIL_EVENT) {
            $this->mailer->send($message->getFrom(), $message->getTo(), $message->getSubject(), $message->getBody());
        }
        return $this;
    }

    /**
     * @param mixed $priority
     * @return EmailSender
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }
}