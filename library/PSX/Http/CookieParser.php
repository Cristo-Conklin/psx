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

namespace PSX\Http;

use DateTime;

/**
 * CookieParser
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class CookieParser
{
	/**
	 * Converts an Cookie header into an array of cookie objects
	 *
	 * @param string $header
	 * @return array<PSX\Http\Cookie>
	 */
	public static function parseCookie($header)
	{
		$parts   = explode(';', $header);
		$cookies = array();

		foreach($parts as $part)
		{
			$kv = explode('=', $part, 2);

			$name  = isset($kv[0]) ? trim($kv[0]) : null;
			$value = isset($kv[1]) ? $kv[1] : null;

			if(!empty($name))
			{
				$cookies[] = new Cookie($name, $value);
			}
		}

		return $cookies;
	}

	/**
	 * Converts an Set-Cookie header to an cookie object
	 *
	 * @param string $header
	 * @return PSX\Http\Cookie
	 */
	public static function parseSetCookie($header)
	{
		$parts = explode(';', $header);

		// get cookie key value pair
		$name  = null;
		$value = null;

		if(isset($parts[0]))
		{
			$kv = explode('=', $parts[0], 2);

			$name  = isset($kv[0]) ? $kv[0] : null;
			$value = isset($kv[1]) ? $kv[1] : null;

			unset($parts[0]);
		}

		if(empty($name))
		{
			// we received an invalid cookie
			return null;
		}

		// get cookie attributes
		$domain   = null;
		$path     = null;
		$expires  = null;
		$secure   = null;
		$httponly = null;

		foreach($parts as $part)
		{
			$kv  = explode('=', $part, 2);
			$key = isset($kv[0]) ? trim($kv[0]) : null;
			$key = strtolower($key);
			$val = isset($kv[1]) ? $kv[1] : null;

			switch($key)
			{
				case 'domain':
					// remove leading dot
					if(isset($val[0]) && $val[0] == '.')
					{
						$val = substr($val, 1);
					}

					$domain = $val;
					break;

				case 'path':
					$path = $val;
					break;

				case 'expires':
					$expires = new DateTime($val);
					break;

				case 'secure':
					$secure = true;
					break;

				case 'httponly':
					$httponly = true;
					break;
			}
		}

		return new Cookie($name, $value, $expires, $path, $domain, $secure, $httponly);
	}
}
