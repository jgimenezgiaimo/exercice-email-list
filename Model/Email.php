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

class Email extends AbstractEmail
{

    protected $user;

    /**
     * @param string $from
     * @param string $subject
     * @param string $body
     * @return AbstractEmail
     */
    function pushEmail(string $from, string $subject, string $body)
    {
        $message = $this->messageFactory->create($from, $this->getEmail(), $subject, $body);
        $message->dispatch(Message::SEND_EMAIL_EVENT);
        return $this;
    }

    /**
     * @param mixed $user
     * @return Email
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

}