<?php

/**
 * IdentifiableTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements functionality of {@link IdentifiableContent}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait IdentifiableTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attributes(): HtmlAttributeManager;

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  int $length the length of the identity value
   * @return string 
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(int $length = 16): string {
    return $this->attributes()->identify($length);
  }

  /**
   * Checks whether the identifying attribute is set or not
   *
   * @return boolean true if the identity is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function hasId(): bool {
    return $this->attributes()->hasId();
  }

}
