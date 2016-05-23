<?php

/**
 * Tfoot.php (UTF-8)
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
 * Class Models an HTML &lt;tfoot&gt; tag.
 *
 *  The {@link self} component is used to group footer content in a
 *  {@link Table}.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_tfoot.asp w3schools API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tfoot extends TableRowContainer {

	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "tfoot";

	/**
	 * Constructs a new instance
	 * 
	 * **Notes:**
	 * 
	 *  * A mixed `$row` can be of any type that converts to a PHP string
	 *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
	 *
	 * @param  null|mixed|mixed[] $row the row being appended
	 */
	public function __construct($row = null) {
		parent::__construct(self::TAG_NAME, $row);
		$this->setDefaultTableCellType(Th::TAG_NAME);
	}

}
