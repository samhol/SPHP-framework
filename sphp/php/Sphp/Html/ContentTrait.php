<?php

/**
 * ContentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Trait implements parts of the {@link ContentInterface} interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-11
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentTrait {

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the component
	 * @throws \Exception if html parsing fails
	 */
	public abstract function getHtml();

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the object
	 */
	public function __toString() {
		try {
			$output = "" . $this->getHtml();
		} catch (\Exception $e) {
			$output = $e->__toString();
		}
		return $output;
	}

	/**
	 * Prints the component as HTML markup string
	 *
	 * @return self for PHP Method Chaining
	 */
	public function printHtml() {
		echo $this;
		return $this;
	}

}
