<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
