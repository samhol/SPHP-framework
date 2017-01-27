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
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EmptyTag extends AbstractTag {

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the name of the tag
   * @param  string[] $attrs an array of attribute name value pairs
   */
  function __construct($tagName, array $attrs = []) {
    parent::__construct($tagName);
    $this->setAttrs($attrs);
  }

  public function getHtml() {
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
