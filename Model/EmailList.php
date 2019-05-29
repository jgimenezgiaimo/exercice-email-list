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

namespace Challenge\Model;

use Challenge\Factory\MessageFactory;
use Challenge\Repository\EmailRepository;

class EmailList extends AbstractEmail implements Distributable
{
    /**
     * @var AbstractEmail[]
     */
    protected $emailList;
    /**
     * @var EmailRepository
     */
    protected $emailRepository;

    /**
     * EmailList constructor.
     * Contemplate Dependency Injection
     * Contemplando Inyeccion de dependencias se instancia el publisher en el constructor
     * @param MessageFactory $messageFactory
     * @param EmailRepository $emailRepository
     */
    public function __construct(
        MessageFactory $messageFactory,
        EmailRepository $emailRepository
    ) {
        parent::__construct($messageFactory);
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param string $from
     * @param string $subject
     * @param string $body
     * @return EmailList
     */
    function pushEmail(string $from, string $subject, string $body)
    {
        $this->distributable($from, $subject, $body);
        $message = $this->messageFactory->create($from, $this->getEmail(), $subject, $body);
        $message->dispatch(Message::SEND_EMAIL_LIST_EVENT);
        return $this;
    }

    /**
     * @param string $from
     * @param string $subject
     * @param string $body
     * @return Distributable
     */
    public function distributable(string $from, string $subject, string $body): Distributable
    {
        $fromEmail = $this->emailRepository->findByEmail($from);
        /** @var $email AbstractEmail */
        foreach ($this->getFilteredEmailList($fromEmail) as $email) {
            $email->pushEmail($from, $subject, $body);
        }
        return $this;
    }

    /**
     * @param AbstractEmail[] $emailList
     * @return EmailList
     */
    public function setEmailList($emailList)
    {
        $this->emailList = $emailList;
        return $this;
    }

    /**
     * @param AbstractEmail $email
     * @return EmailList
     */
    public function addEmailToList(AbstractEmail $email)
    {
        if (!is_array($this->emailList)) {
            $this->emailList = [];
        }
        $this->emailList[] = $email;
        return $this;
    }

    /**
     * @return AbstractEmail[]
     */
    public function getEmailList()
    {
        return $this->emailList;
    }

    /**
     * @param AbstractEmail $fromEmail
     * @return array
     */
    protected function getFilteredEmailList(AbstractEmail $fromEmail)
    {
        $filtered = [];
        if ($fromEmail) {
            return $filtered;
        }
        foreach ($this->getEmailList() as $email) {
            if ($this->isEqualToFrom($email, $fromEmail)) {
                continue;
            }
            $filtered[] = $email;
        }
        return $filtered;
    }

    /**
     * @param AbstractEmail $email
     * @param AbstractEmail $from
     * @return bool
     */
    protected function isEqualToFrom(AbstractEmail $email, AbstractEmail $from): bool
    {
        if ($email === $from) {
            return true;
        }
        if (($email instanceof Email) && ($from instanceof Email)) {
            if ($email->getUser() === $from->getUser()) {
                return true;
            }
        }
        return false;
    }
}