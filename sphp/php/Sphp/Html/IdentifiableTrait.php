<?php

/**
 * IdentifiableComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyAttribute;

/**
 * Trait implements functionality of the {@link ComponentInterface} and {@link IdentifiableInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait IdentifiableTrait {

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
    return $this->attrs()->identify($length);
  }

  /**
   * Checks whether the identifying attribute is set or not
   *
   * @return boolean true if the identity is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function hasId(): bool {
    return $this->attrs()->hasId();
  }

}
