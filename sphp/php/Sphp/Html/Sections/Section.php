<?php

/**
 * Section.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Sections;

use Sphp\Html\ContainerTag;
use Sphp\Html\Headings\HeadingInterface;

/**
 * Class Models an HTML &lt;section&gt; tag
 *
 *  This component defines sections in a document, such as chapters, headers, 
 *  footers, or any other sections of the document.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-25
 * @link    http://www.w3schools.com/tags/tag_section.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Section extends ContainerTag {

  /**
   * Constructs a new instance
   * 
   * @param  mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('section', $content);
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
   * Returns the paragraphs in this section
   *
   * @return Paragraph the body tag object
   */
  public function paragraphs() {
    return $this->getComponentsByObjectType(Paragraph::class);
  }

}
