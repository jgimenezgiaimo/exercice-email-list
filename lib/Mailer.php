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

namespace Challenge\Lib;

/**
 * Clase Mailer creada a modo ilustrativo no funcional
 */
class Mailer
{
    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $body
     * @return Mailer
     */
    public function send($from, $to, $subject, $body): Mailer
    {
        /**
         * Aqui envio de mail
         **/
        return $this;
    }
}