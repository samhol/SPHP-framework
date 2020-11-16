<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

/**
 * Defines the basic functionality of an identifiable HTML component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    http://www.w3schools.com/tags/att_global_id.asp id attribute
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface IdentifiableContent extends Content {

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is 
   * checked for its uniqueness.
   * 
   * @param  mixed $id the value of the id attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function setId(string $id);

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  bool $forceNewValue whether a new id value is created or not
   * @return string 
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(bool $forceNewValue = false): string;
}
