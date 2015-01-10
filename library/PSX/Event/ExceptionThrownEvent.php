<?php
/*
 * psx
 * A object oriented and modular based PHP framework for developing
 * dynamic web applications. For the current version and informations
 * visit <http://phpsx.org>
 *
 * Copyright (c) 2010-2015 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * This file is part of psx. psx is free software: you can
 * redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or any later version.
 *
 * psx is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with psx. If not, see <http://www.gnu.org/licenses/>.
 */

namespace PSX\Event;

use Psr\Http\Message\RequestInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * ExceptionThrownEvent
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 * @see     http://www.ietf.org/rfc/rfc4287.txt
 */
class ExceptionThrownEvent extends Event
{
	protected $exception;
	protected $context;

	public function __construct(\Exception $exception, ContextInterface $context)
	{
		$this->exception = $exception;
		$this->context   = $context;
	}

	public function getException()
	{
		return $this->exception;
	}

	public function getContext()
	{
		return $this->context;
	}
}
