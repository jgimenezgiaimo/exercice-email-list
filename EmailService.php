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

namespace Challenge;

use Challenge\Repository\EmailRepository;

/***
 * Class EmailService
 * Implementacion de ejercicio de modelado de listas de Email
 * El codigo es solo orientativo no funcional, para realizar una descripcion un poco mas completa en un Pseudo Codigo PHP
 *
 */
class EmailService
{
    /**
     * @var EmailRepository
     */
    protected $emailRepository;

    /**
     * EmailService constructor.
     * @param EmailRepository $emailRepository
     */
    public function __construct(
        EmailRepository $emailRepository
    ) {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return EmailService
     */
    public function sendEmail(string $from, string $to, string $subject, string $body): EmailService
    {
        $email = $this->emailRepository->findByEmail($to);
        $email->pushEmail($from, $to, $subject, $body);
        return $this;
    }
}