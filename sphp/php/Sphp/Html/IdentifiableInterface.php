<?php

/**
 * IdentifiableInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines the basic functionality of an identifiable HTML component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @filesource
 */
interface IdentifiableInterface {

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  string $identityName the name of the identity attribute
   * @param  string $prefix optional prefix of the identity value
   * @param  int $length the length of the identity value
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify($identityName = 'id', $prefix = 'id', $length = 16);

  /**
   * Checks whether the identifying attribute is set or not
   *
   * @param  string $identityName optional name of the identifying attribute
   * @return boolean true if the identity is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function hasId($identityName = 'id');
}
