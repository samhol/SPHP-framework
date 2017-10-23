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

  public function getHtml(): string {
    $output = '<' . $this->getTagName();
    if (!$this->attrs()->isEmpty()) {
      $output .= ' ' . $this->attrs();
    }
    if (Document::isXHTML()) {
      $output .= ' />';
    } else {
      $output .= '>';
    }
    return $output;
  }

}
