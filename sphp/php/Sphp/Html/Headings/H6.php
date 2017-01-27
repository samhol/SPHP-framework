<?php

/**
 * H6.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Headings;

/**
 * Implements a HTML heading of level 6
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-13
 * @link    http://www.w3schools.com/tags/tag_hn.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-h1-h2-h3-h4-h5-and-h6-elements W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class H6 extends AbstractHeading {

	/**
	 * Constructs a new instance
	 * 
	 * @param  mixed $content optional content of the component
	 */
	public function __construct($content = null) {
		parent::__construct('h6', $content);
	}

}
