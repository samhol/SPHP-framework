<?php

/**
 * AbstractHeading.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Headings;

use Sphp\Html\ContainerTag;

/**
 * Abstract implementation of HTML headings and subheadings
 *
 * HTML heading Components rank in importance according to the number in their name.
 * The h1 element is said to have the highest rank, the h6 element has the lowest 
 * rank, and two elements with the same name have equal rank.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-12-15
 * @link    http://www.w3schools.com/tags/tag_hn.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-h1-h2-h3-h4-h5-and-h6-elements W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractHeading extends ContainerTag implements HeadingInterface {

	public function getLevel() {
		return substr($this->getTagName(), 1);
	}

}
