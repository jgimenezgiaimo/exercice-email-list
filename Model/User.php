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

class User
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Email[]
     */
    protected $emails;

    /**
     * @param Email[] $emails
     * @return User
     */
    public function setEmails(array $emails): User
    {
        $this->emails = $emails;
        return $this;
    }

    /**
     * @param Email $email
     * @return User
     */
    public function addEmail(Email $email): User
    {
        if (!is_array($this->emails)) {
            $this->emails[] = $email;
        }
        $this->emails[] = $email;
        return $this;
    }

    /**
     * @param Email $email
     * @return User
     */
    public function removeEmail(Email $email): User
    {
        $objectKey = spl_object_hash($email);
        if (is_array($this->emails) && array_key_exists($objectKey, $this->emails)) {
            unset($this->emails[$objectKey]);
        }
        return $this;
    }

    /**
     * @return Email[]
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}