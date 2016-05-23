<?php

/**
 * Section.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Sections;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Headings\HeadingInterface as HeadingInterface;
/**
 * Class Models an HTML &lt;section&gt; tag
 *
 *  This component defines sections in a document, such as chapters, headers, 
 *  footers, or any other sections of the document.
 * 
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-25
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_section.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Section extends ContainerTag {

	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "section";

	/**
	 * Constructs a new instance
	 * 
	 * @param  mixed $content optional content of the component
	 */
	public function __construct($content = null) {
		parent::__construct(self::TAG_NAME, $content);
	}

	/**
	 * Returns the heading components tag object
	 *
	 * @return HeadingInterface the body tag object
	 */
	public function headings() {
		return $this->getComponentsByObjectType(HeadingInterface::class);
	}

	/**
	 * Returns the heading components tag object
	 *
	 * @return HeadingInterface the body tag object
	 */
	public function paragraphs() {
		return $this->getComponentsByObjectType(HeadingInterface::class);
	}

}
