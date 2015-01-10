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

namespace PSX;

use ArrayIterator;
use PSX\Config\NotFoundException;

/**
 * Simple config class which uses a simple array to store all values. Here an
 * example howto use the class
 * <code>
 * $config = Config::fromFile('configuration.php');
 *
 * echo $config['psx_url'];
 * </code>
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class Config extends ArrayIterator
{
	/**
	 * The container for the config array
	 *
	 * @var array
	 */
	private $container = array();

	public function __construct(array $config)
	{
		parent::__construct($config);
	}

	public function set($key, $value)
	{
		$this->offsetSet($key, $value);
	}

	public function get($key)
	{
		return $this->offsetGet($key);
	}

	public function has($key)
	{
		return $this->offsetExists($key);
	}

	public function merge(Config $config)
	{
		return new Config(array_merge($this->getArrayCopy(), $config->getArrayCopy()));
	}

	public static function fromFile($file)
	{
		$config = include($file);

		if(is_array($config))
		{
			return new self($config);
		}
		else
		{
			throw new NotFoundException('Config file must return an array');
		}
	}
}
