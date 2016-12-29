<?php

/**
 * Thead.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;thead&gt; tag
 *
 *  This component is used to group header content in a 
 *  {@link Table} component.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @link    http://www.w3schools.com/tags/tag_thead.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Thead extends TableRowContainer {

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
		parent::__construct('thead', $row);
		$this->setDefaultTableCellType('th');
	}

}
