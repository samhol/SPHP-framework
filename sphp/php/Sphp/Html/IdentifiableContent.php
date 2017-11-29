<?php

/**
 * IdentifiableContent.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines the basic functionality of an identifiable HTML component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @filesource
 */
interface IdentifiableContent extends Content {

  /**
   * Identifies the element with an unique id attribute
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  int $length the length of the identity value
   * @return string the identifier
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(int $length = 16): string;

  /**
   * Checks whether the identifying attribute is set or not
   *
   * @return boolean true if the identity is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function hasId(): bool;
}

