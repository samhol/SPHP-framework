<?php

/**
 * TableRowContainer.php (UTF-8)
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

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class Models an HTML table row collection namely (&lt;thead&gt;, &lt;tbody&gt; or &lt;tfoot&gt;)
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class TableRowContainer extends ContainerTag implements TableContentInterface {

	/**
	 * Counts the {@link RowInterface} components in the table
	 */
	const COUNT_NORMAL = 1;

	/**
	 * Counts the {@link CellInterface} components in the table
	 */
	const COUNT_CELLS = 2;
	
	/**
	 * the default type of the table cells ({@link Td::TAG_NAME}|{@link Th::TAG_NAME})
	 *
	 * @var string 
	 */
	private $cellType = Td::TAG_NAME;
	
	/**
	 * Sets the default type of the table cells
	 * 
	 * `$defaultCell` parameter defines the type of the wrapper for`$cells` not instanceof  {@link CellInterface}
	 *  
	 *  * {@link Td::TAG_NAME} => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Td} component
	 *  * {@link Th::TAG_NAME} => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Th} component
	 * 
	 * @param  string $defaultCell
	 * @return self for PHP Method Chaining
	 */
	public function setDefaultTableCellType($defaultCell) {
		$this->cellType = $defaultCell;
		return $this;
	}

	/**
	 * Sets the default type of the table cells
	 * 
	 * @return string the default type of the cell
	 *         ({@link Td::TAG_NAME}|{@link Th::TAG_NAME})
	 */
	public function getDefaultCellType() {
		return $this->cellType;
	}


	/**
	 * Wraps any non {@link RowInterface} input within a {@link Tr} object
	 *
	 * **Notes:**
	 * 
	 *  * A mixed `$row` can be of any type that converts to a PHP string
	 *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
	 *
	 * @param  mixed|mixed[] $row the row being appended
	 * @return RowInterface wrapped input
	 */
	private function trWrapper($row) {
		if (!($row instanceof RowInterface)) {
			return new Tr($row, $this->getDefaultCellType());
		} else {
			return $row;
		}
	}

	/**
	 * Appends a {@link RowInterface} object to the container object
	 *
	 * **Notes:**
	 * 
	 *  * A mixed `$row` can be of any type that converts to a PHP string
	 *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
	 *
	 * @param  mixed|mixed[] $row the row being appended
	 * @return self for PHP Method Chaining
	 */
	public function append($row) {
		parent::append($this->trWrapper($row));
		return $this;
	}

	/**
	 * Prepends a {@link RowInterface} to the object
	 *
	 * **Notes:**
	 * 
	 *  * A mixed `$row` can be of any type that converts to a PHP string
	 *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
	 *  * The numeric keys of the container will be renumbered starting from zero
	 *
	 * @param  mixed|mixed[] $row the row(s) being appended
	 * @return self for PHP Method Chaining
	 */
	public function prepend($row) {
		parent::prepend($this->trWrapper($row));
		return $this;
	}

	/**
	 * Assigns a table row {@link RowInterface} to the specified offset
	 *
	 * **Notes:**
	 *
	 *  * A mixed `$row` can be of any type that converts to a PHP string
	 *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
	 *
	 * @param mixed $offset the offset to assign the value to
	 * @param mixed|mixed[]|RowInterface $row the value to set
	 * @link  http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetGet
	 */
	public function offsetSet($offset, $row) {
		parent::offsetSet($offset, $this->trWrapper($row));
	}

	/**
	 * Count the number of inserted components in the table
	 *
	 * **`$mode` parameter values:**
	 * 
	 * * {@link self::COUNT_NORMAL} counts the {@link RowInterface} components in the table
	 * * {@link self::COUNT_CELLS} counts the {@link CellInterface} components in the table
	 *
	 * @param  int $mode defines the type of the objects to count
	 * @return int number of the components in the html table
	 * @link   http://php.net/manual/en/class.countable.php Countable
	 */
	public function count($mode = self::COUNT_NORMAL) {
		if ($mode == self::COUNT_CELLS) {
			$count = 0;
			foreach ($this as $row) {
				$count += $row->count();
			}
			return $count;
		} else {
			return parent::count();
		}
	}

}
