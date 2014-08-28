<?php
/*
 * psx
 * A object oriented and modular based PHP framework for developing
 * dynamic web applications. For the current version and informations
 * visit <http://phpsx.org>
 *
 * Copyright (c) 2010-2014 Christoph Kappestein <k42b3.x@gmail.com>
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

namespace PSX\Oauth2\Provider;

use PSX\Dispatch\RedirectException;
use PSX\Http\GetRequest;
use PSX\Http\Response;
use PSX\Http\Stream\TempStream;
use PSX\Json;
use PSX\Oauth2\Provider\GrantType\TestImplicit;
use PSX\Test\ControllerTestCase;
use PSX\Url;

/**
 * AuthorizationAbstractTest
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class AuthorizationAbstractTest extends ControllerTestCase
{
	protected function setUp()
	{
		parent::setUp();

		$grantTypeFactory = new GrantTypeFactory();
		$grantTypeFactory->add(new TestImplicit());

		getContainer()->set('oauth2_grant_type_factory', $grantTypeFactory);
	}

	public function testHandleCodeGrant()
	{
		$response = $this->callEndpoint(array(
			'response_type' => 'code',
			'client_id' => 'foo',
			'redirect_uri' => 'http://foo.com',
			'scope' => '',
			'state' => 'random',

			// test implementation specific parameters
			'has_grant' => 1,
			'code' => 'foobar',
		));

		$this->assertEquals(307, $response->getStatusCode());
		$this->assertEquals('http://foo.com?code=foobar&state=random', $response->getHeader('Location'));
	}

	public function testHandleCodeNoGrant()
	{
		$response = $this->callEndpoint(array(
			'response_type' => 'code',
			'client_id' => 'foo',
			'redirect_uri' => 'http://foo.com',
			'scope' => '',
			'state' => 'random',

			// test implementation specific parameters
			'has_grant' => 0,
			'code' => 'foobar',
		));

		$this->assertEquals(307, $response->getStatusCode());
		$this->assertEquals('http://foo.com?error=unauthorized_client&error_description=Client+is+not+authenticated', $response->getHeader('Location'));
	}

	public function testHandleTokenGrant()
	{
		$response = $this->callEndpoint(array(
			'response_type' => 'token',
			'client_id' => 'foo',
			'redirect_uri' => 'http://foo.com',
			'scope' => '',
			'state' => 'random',

			// test implementation specific parameters
			'has_grant' => 1,
			'code' => 'foobar',
		));

		$this->assertEquals(307, $response->getStatusCode());
		$this->assertEquals('http://foo.com#access_token=2YotnFZFEjr1zCsicMWpAA&token_type=example&state=random', $response->getHeader('Location'));
	}

	public function testHandleTokenNoGrant()
	{
		$response = $this->callEndpoint(array(
			'response_type' => 'token',
			'client_id' => 'foo',
			'redirect_uri' => 'http://foo.com',
			'scope' => '',
			'state' => 'random',

			// test implementation specific parameters
			'has_grant' => 0,
			'code' => 'foobar',
		));

		$this->assertEquals(307, $response->getStatusCode());
		$this->assertEquals('http://foo.com?error=unauthorized_client&error_description=Client+is+not+authenticated', $response->getHeader('Location'));
	}

	public function testHandleNoParameter()
	{
		$response = $this->callEndpoint(array());
		$data     = Json::decode((string) $response->getBody());

		$this->assertEquals(false, $data['success']);
		$this->assertEquals('PSX\Oauth2\Authorization\Exception\InvalidRequestException', $data['title']);
	}

	protected function callEndpoint(array $params)
	{
		$url      = new Url('http://127.0.0.1/auth?' . http_build_query($params, '', '&'));
		$body     = new TempStream(fopen('php://memory', 'r+'));
		$request  = new GetRequest($url, array());
		$response = new Response();
		$response->setBody($body);

		$this->loadController($request, $response);

		return $response;
	}

	protected function getPaths()
	{
		return array(
			'/auth' => 'PSX\Oauth2\Provider\TestAuthorizationAbstract',
		);
	}
}
