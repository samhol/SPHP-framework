<?php

/**
 * AbstractComponent.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Abstract Class provides a simple implementation of the component containing other components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractComponent extends AbstractTag {

  /**
   * Returns opening tag with its attributes
   *
   * @return string opening tag with attributes
   */
  public function getOpeningTag(): string {
    $attrs = '' . $this->attrs();
    if ($attrs != '') {
      $attrs = ' ' . $attrs;
    }
    return '<' . $this->getTagName() . $attrs . '>';
  }

  /**
   * Returns the content of the component as a string
   *
   * @return string content as a string
   * @throws \Sphp\Exceptions\RuntimeException if content parsing fails
   */
  abstract public function contentToString(): string;

  /**
   * Returns closing tag
   *
   * @return string closing tag
   */
  public function getClosingTag(): string {
    return '</' . $this->getTagName() . '>';
  }

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Sphp\Exceptions\RuntimeException if HTML parsing fails
   */
  public function getHtml(): string {
    return $this->getOpeningTag() . $this->contentToString() . $this->getClosingTag();
  }

}
