<?php

/**
 * Colgroup.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;

/**
 * Class models an HTML &lt;colgroup&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Colgroup extends ContainerTag implements TableContentInterface {

	/**
	 * Constructs a new instance
	 *
	 * @param  Col|Col[]|null $cols The ColTag(s) objects that specifies column properties
	 */
	public function __construct($cols = null) {
		parent::__construct('colgroup');
		if (isset($cols)) {
			$this->append($cols);
		}
	}

	/**
	 * Appends a {@link Col} with a specific span and CSS class values to the colgroup
	 *
	 * @param  string $span specifies the number of columns a col element should span
	 * @param  string|string[] $cssClasses CSS classes
	 * @return self for PHP Method Chaining
	 */
	public function appendCol($span = 1, $cssClasses = '') {
		$this->append(new Col($span, $cssClasses));
		return $this;
	}

	/**
	 * Appends cols(s) to the colgroup
	 *
	 * @param  Col|Col[] $cols The ColTag(s) objects that specifies column properties
	 * @return self for PHP Method Chaining
	 */
	public function append($cols) {
		parent::append($cols);
		return $this;
	}

	/**
	 * Prepends cols(s) to the colgroup
	 *
	 * **Important!** The numeric keys of the object will be renumbered starting from zero
	 *
	 * @param  Col|Col[] $cols The ColTag(s) objects that specifies column properties
	 * @return self for PHP Method Chaining
	 */
	public function prepend($cols) {		
		parent::prepend($cols);
		return $this;
	}

	/**
	 * Assigns a {@link ColTag} object to the specified offset
	 *
	 * @param  mixed $offset the offset to assign the value to
	 * @param  Col $colTag the ColTag object to set
	 * @throws \InvalidArgumentException if the type of the $colTag parameter is not {@link ColTag}
	 * @link   http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetSet
	 */
	public function offsetSet($offset, $colTag) {
		if (!($colTag instanceof Col)) {
			throw new \InvalidArgumentException('The type of the colTag attribute must be ' . get_class(new Col));
		}
		parent::offsetSet($offset, $colTag);
	}

}
