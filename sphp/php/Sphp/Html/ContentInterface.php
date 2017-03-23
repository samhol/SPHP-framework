<?php

/**
 * ContentInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines basic features for all HTML structures
 *
 * **Links to HTML-resources:**
 * 
 * * <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
 * * <a href="http://www.w3.org/TR/html4/">W3C's HTML 4.01 Specification</a>
 * * <a href="http://www.w3.org/TR/xhtml1/">W3C's XHTML 1.0 Specification</a>
 * * <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
 * * <a href="http://validator.w3.org/">W3C Markup Validation Service</a>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ContentInterface {

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the component
	 * @throws \Sphp\Exceptions\RuntimeException if html parsing fails
	 */
	public function getHtml();

	/**
	 * Returns the component as HTML markup string
	 *
	 * @return string HTML markup of the object
	 * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
	 */
	public function __toString();

	/**
	 * Prints the component as HTML markup string
	 *
	 * @return self for a fluent interface
	 */
	public function printHtml();
}
