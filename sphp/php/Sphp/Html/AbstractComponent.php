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
 * @since   2014-03-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractComponent extends AbstractTag {

  /**
   * Returns opening tag with its attributes
   *
   * @return string opening tag with attributes
   */
  public function getOpeningTag() {
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
   * @throws \Exception if content parsing fails
   */
  abstract public function contentToString();

  /**
   * Returns closing tag
   *
   * @return string closing tag
   */
  public function getClosingTag() {
    return '</' . $this->getTagName() . '>';
  }

  /**
   * Returns the component as html-markup string
   *
   * @return string html-markup of the component
   * @throws \Exception if html parsing fails
   */
  public function getHtml() {
    return $this->getOpeningTag() . $this->contentToString() . $this->getClosingTag();
  }

}
