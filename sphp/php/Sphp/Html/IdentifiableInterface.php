<?php

/**
 * ComponentInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\IdentityChanger as IdentityChanger;

/**
 * Interface specifies the basic functionality of an identifiable HTML component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @filesource
 */
interface IdentifiableInterface extends IdentityChanger {

  /**
   * Sets the value of the id attribute
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   *
   * @param  string $id the value of the id attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function setId($id);

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   *
   * @param  string $seed id attributes seed
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function identify($seed = "id");

  /**
   * Returns the value of the id attribute
   *
   * @return string the value of the id attribute
   * @link http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function getId();

  /**
   * Checks whether the id attribute is set or not
   *
   * @return boolean true if the id attribute is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function hasId();
}
