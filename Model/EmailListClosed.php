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


class EmailListClosed extends EmailList
{
    /**
     * @var User[]
     */
    protected $publishers;

    /**
     * @param User[] $publishers
     * @return EmailListClosed
     */
    public function setPublishers(array $publishers): EmailListClosed
    {
        $this->publishers = $publishers;
        return $this;
    }

    /**
     * @param User $publisher
     * @return EmailListClosed
     */
    public function addPublisher(User $publisher): EmailListClosed
    {
        $this->publishers[] = $publisher;
        return $this;
    }

    /**
     * @param User $publisher
     * @return EmailListClosed
     */
    public function removePublisher(User $publisher): EmailListClosed
    {
        $objectKey = spl_object_hash($publisher);
        if (is_array($this->publishers) && array_key_exists($objectKey, $this->publishers)) {
            unset($this->publishers[$objectKey]);
        }
        return $this;
    }

    /**
     * @return User[]
     */
    public function getPublishers(): array
    {
        return $this->publishers;
    }

    /**
     * @param AbstractEmail $fromEmail
     * @return array
     */
    protected function getFilteredEmailList(AbstractEmail $fromEmail)
    {
        if ($fromEmail instanceof Email) {
            if (!$this->isMyPublisher($fromEmail->getUser())) {
                return [];
            }
        }
        return parent::getFilteredEmailList($fromEmail);
    }


    /**
     * @param User $publisher
     * @return bool
     */
    protected function isMyPublisher(User $publisher): bool
    {
        foreach ($this->publishers as $myPublisher) {
            if ($publisher === $myPublisher) {
                return true;
            }
        }
        return false;
    }
}