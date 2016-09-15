<?php

/**
 * IdentifyingAttributeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * An implementation of a HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-09-28
 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface IdentifyingAttributeInterface extends AttributeInterface {

  /**
   * Identifies HtmlElement with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   *
   * @param  string $seed id attributes seed
   * @param  boolean $locked
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function identify($seed = "id_", $locked = false);

  /**
   * Attaches an observer so that it can be notified of identity changes
   *
   * @param  callable|IdentityObserver $observer
   * @return self for PHP Method Chaining
   */
  public function attachIdentityObserver($observer);

  /**
   * Detaches an observer from the subject to no longer notify it of identity changes
   *
   * @param  callable|IdentityObserver $observer
   * @return self for PHP Method Chaining
   */
  public function detachIdentityObserver($observer);

  /**
   * Notifies all attached identity observers
   *
   * @return self for PHP Method Chaining
   */
  public function notifyIdentityChange();
}
