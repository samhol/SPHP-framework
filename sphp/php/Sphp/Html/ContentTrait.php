<?php

/**
 * ContentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Throwable;

/**
 * Trait implements parts of the {@link ContentInterface} interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentTrait {

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the component
	 * @throws \Sphp\Exceptions\Exception if HTML parsing fails
	 */
	public abstract function getHtml(): string;

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the object
	 */
	public function __toString(): string {
		try {
			$output = '' . $this->getHtml();
		} catch (Throwable $e) {
			$output = $e->getMessage();
		}
		return $output;
	}

	/**
	 * Prints the component as HTML markup string
	 *
   * @return $this for a fluent interface
	 */
	public function printHtml() {
		echo $this;
		return $this;
	}

}
