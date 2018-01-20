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

  private $close = false;

  public function __construct(string $tagName, bool $useCloseTag = false, Attributes\HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->close = $useCloseTag;
  }

  public function getHtml(): string {
    $output = '<' . $this->getTagName();
    if ($this->attributes()->containsAttributes()) {
      $output .= ' ' . $this->attributes();
    }
    $output .= '>';
    if ($this->close) {
      $output .= "</{$this->getTagName()}>";
    }
    return $output;
  }

}
