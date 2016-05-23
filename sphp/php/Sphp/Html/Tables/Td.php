<?php

/**
 * Td.php (UTF-8)
 *
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 *
 * This file is part of SPH framework.
 *
 * SPH framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SPH framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SPH framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Sphp\Html\Tables;

/**
 * Class models an HTML &lt;table&gt; tag's cell (&lt;td&gt; tag)
 * 
 * The {@link self} defines a standard cell in a {@link Table} component
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-08-28
 * @version 2.0.0
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Td extends Cell {

	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "td";
	
	/**
	 * Constructs a new instance
	 *
	 * <p>**Important!**</p>
	 *
	 * <p>Parameter `$content` can be of any type that converts to a
	 * string or to an array of strings. So also an object of any class that
	 * implements magic method `__toString()` is allowed.</p>
	 *
	 *  <p>**Preconditions:**</p>
	 *  <ol>
	 *    * $colspan >= 1 & $rowspan >= 1
	 *  </ol>
	 *
	 * @param mixed $content the content of the component
	 * @param int $colspan the value of the colspan attribute
	 * @param int $rowspan the value of the rowspan attribute
	 * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
	 * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
	 */
	public function __construct($content = null, $colspan = 1, $rowspan = 1) {
		parent::__construct(self::TAG_NAME, $content);
		$this->setColspan($colspan);
		$this->setRowspan($rowspan);
	}

}
