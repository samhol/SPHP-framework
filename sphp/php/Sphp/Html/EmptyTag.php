<?php

/**
 * EmptyTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Implements an empty tag
 *
 * Empty tag has only attributes and no content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EmptyTag extends AbstractTag {

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the name of the tag
   */
  function __construct(string $tagName) {
    parent::__construct($tagName);
  }

  public function getHtml(): string {
    $attrs = '' . $this->attrs();
    if ($attrs !== '') {
      $attrs = ' ' . $attrs;
    }
    $output = '<' . $this->getTagName() . $attrs;
    if (Document::isXHTML()) {
      $output .= ' />';
    } else {
      $output .= '>';
    }
    return $output;
  }

}
