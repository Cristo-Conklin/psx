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

namespace PSX\Sql;

use PSX\Config;
use PSX\Data\Record;
use PSX\DateTime;
use PSX\Sql;
use PSX\Sql\Table\Select;
use PSX\Sql\TableInterface;
use PSX\Test\TableDataSet;

/**
 * TableTest
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class TableTest extends DbTestCase
{
	use TableTestCase;

	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(__DIR__ . '/table_fixture.xml');
	}

	protected function getTable()
	{
		return getContainer()->get('table_manager')->getTable('PSX\Sql\TestTable');
	}

	public function testGetName()
	{
		$this->assertEquals('psx_handler_comment', $this->getTable()->getName());
	}

	public function testGetColumns()
	{
		$expect = array(
			'id'     => TableInterface::TYPE_INT | 10 | TableInterface::PRIMARY_KEY | TableInterface::AUTO_INCREMENT,
			'userId' => TableInterface::TYPE_INT | 10,
			'title'  => TableInterface::TYPE_VARCHAR | 32,
			'date'   => TableInterface::TYPE_DATETIME,
		);

		$this->assertEquals($expect, $this->getTable()->getColumns());
	}

	public function testGetConnections()
	{
		$this->assertEquals(array(), $this->getTable()->getConnections());
	}

	public function testGetDisplayName()
	{
		$this->assertEquals('comment', $this->getTable()->getDisplayName());
	}

	public function testGetPrimaryKey()
	{
		$this->assertEquals('id', $this->getTable()->getPrimaryKey());
	}

	public function testHasColumn()
	{
		$this->assertTrue($this->getTable()->hasColumn('title'));
		$this->assertFalse($this->getTable()->hasColumn('foobar'));
	}
}

