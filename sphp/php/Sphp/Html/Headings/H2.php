<?php

/**
 * H2.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Headings;

/**
 * Class represents a HTML heading of level 2
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-13
 * @link    http://www.w3schools.com/tags/tag_hn.asp w3schools API link
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-h1-h2-h3-h4-h5-and-h6-elements W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class H2 extends AbstractHeading {

	/**
	 * Constructs a new instance
	 * 
	 * @param  mixed $content optional content of the component
	 */
	public function __construct($content = null) {
		parent::__construct('h2', $content);
	}

}
