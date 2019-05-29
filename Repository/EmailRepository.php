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

namespace Challenge\Repository;

use Challenge\Model\AbstractEmail;
use Challenge\Model\EmailList;
use Challenge\Model\EmailListClosed;
use Challenge\Model\Email;
use Challenge\Factory\MessageFactory;

/**
 * EmailRepository
 * Acceso a persistencia de datos Repository para consulta y actualizacion de info en DB
 * se describe solo el metodo findByEmail utilizado en el ejemplo
 */
class EmailRepository
{
    /**
     * @param string $email
     * @return AbstractEmail|EmailList|Email|EmailListClosed
     */
    public function findByEmail(string $email): AbstractEmail
    {
        $emailObject = new Email(new MessageFactory()); // implementacion a modo didactico no funcional en
        $emailObject->setEmail($email);
        return $emailObject;
    }
}