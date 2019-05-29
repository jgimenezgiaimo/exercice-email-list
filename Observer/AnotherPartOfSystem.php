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

class AnotherPartOfSystem implements \SplObserver
{

    protected $priority;

    public function update(SplSubject $subject)
    {
        /** @var $subject Message * */
        if ($subject->getEvent() == Message::SEND_EMAIL_LIST_EVENT) {
            // haciendo algo en alguna parte del sistema
        }
    }

    /**
     * @param mixed $priority
     * @return AnotherPartOfSystem
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }
}