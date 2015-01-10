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

namespace PSX\Cache;

/**
 * The handler is the storage enginge of an cache pool
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
interface HandlerInterface
{
	/**
	 * Returns the cache item with the given key. If it doesnt exist it returns
	 * an empty item
	 *
	 * @param string $key
	 * @return PSX\Cache\Item
	 */
	public function load($key);

	/**
	 * Writes the cache item
	 *
	 * @param PSX\Cache\Item $item
	 * @return void
	 */
	public function write(Item $item);

	/**
	 * Removes the cache item associated with the key
	 *
	 * @param string $key
	 * @return void
	 */
	public function remove($key);

	/**
	 * Removes all entries. Returns whether all entries were successful removed
	 *
	 * @return boolean
	 */
	public function removeAll();
}
