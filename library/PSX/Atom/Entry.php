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

namespace PSX\Atom;

use DateTime;
use PSX\Atom;
use PSX\Data\RecordAbstract;
use PSX\Data\RecordInfo;

/**
 * Entry
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class Entry extends RecordAbstract
{
	protected $author;
	protected $category;
	protected $content;
	protected $contributor;
	protected $id;
	protected $link;
	protected $published;
	protected $rights;
	protected $source;
	protected $summary;
	protected $title;
	protected $updated;

	/**
	 * @param PSX\Atom\Person $author
	 */
	public function addAuthor(Person $author)
	{
		if($this->author === null)
		{
			$this->author = array();
		}

		$this->author[] = $author;
	}

	/**
	 * @param array<PSX\Atom\Person> $author
	 */
	public function setAuthor(array $author)
	{
		$this->author = $author;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param PSX\Atom\Category $author
	 */
	public function addCategory(Category $category)
	{
		if($this->category === null)
		{
			$this->category = array();
		}

		$this->category[] = $category;
	}

	/**
	 * @param array<PSX\Atom\Category> $category
	 */
	public function setCategory(array $category)
	{
		$this->category = $category;
	}

	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * @param PSX\Atom\Text $content
	 */
	public function setContent(Text $content)
	{
		$this->content = $content;
	}
	
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param PSX\Atom\Person $contributor
	 */
	public function addContributor(Person $contributor)
	{
		if($this->contributor === null)
		{
			$this->contributor = array();
		}

		$this->contributor[] = $contributor;
	}

	/**
	 * @param array<PSX\Atom\Person> $contributor
	 */
	public function setContributor($contributor)
	{
		$this->contributor = $contributor;
	}

	public function getContributor()
	{
		return $this->contributor;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setRights($rights)
	{
		$this->rights = $rights;
	}
	
	public function getRights()
	{
		return $this->rights;
	}

	/**
	 * @param string $id
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param DateTime $published
	 */
	public function setPublished(DateTime $published)
	{
		$this->published = $published;
	}
	
	public function getPublished()
	{
		return $this->published;
	}

	/**
	 * @param DateTime $updated
	 */
	public function setUpdated(DateTime $updated)
	{
		$this->updated = $updated;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}

	public function addLink(Link $link)
	{
		if($this->link === null)
		{
			$this->link = array();
		}

		$this->link[] = $link;
	}

	/**
	 * @param array<PSX\Atom\Link> $link
	 */
	public function setLink(array $link)
	{
		$this->link = $link;
	}

	public function getLink()
	{
		return $this->link;
	}

	/**
	 * @param PSX\Atom $source
	 */
	public function setSource(Atom $source)
	{
		$this->source = $source;
	}

	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @param PSX\Atom\Text $summary
	 */
	public function setSummary(Text $summary)
	{
		$this->summary = $summary;
	}
	
	public function getSummary()
	{
		return $this->summary;
	}
}

