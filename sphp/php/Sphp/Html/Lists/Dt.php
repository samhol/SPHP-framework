<?php

/**
 * Dt.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class models an HTML &lt;dt&gt; tag
 *
 * The {@link self} component defines an term in a definition list.
 *
 * The {@link self} component is used in conjunction with {@link Descriptor} 
 * (defines the definition list) and &lt;dd&gt; (describes the item in the list)
 * 
 * 
 * A {@link self} component can contain HTML with paragraphs, line breaks, 
 * images, links, lists, etc and/or components implementing these HTML 
 * elements.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_dt.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dt extends ContainerTag implements DlContentInterface {

	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "dt";

	/**
	 * Constructs a new instance
	 * 
	 * A {@link self} component can contain HTML with paragraphs, line breaks, 
	 * images, links, lists, etc and/or components implementing these HTML 
	 * elements.
	 *
	 * @param  null|mixed|mixed[] $items list elements
	 */
	public function __construct($items = null) {
		parent::__construct(self::TAG_NAME, $items);
	}

}
