<?php

/**
 * Tbody.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;tbody&gt; tag.
 *
 *  The {@link self} component is used to group body content in a
 *  {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tbody.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Tbody extends TableRowContainer {

	/**
	 * Constructs a new instance
	 */
	public function __construct() {
		parent::__construct('tbody');
	}


}
