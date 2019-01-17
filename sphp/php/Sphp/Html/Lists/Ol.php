<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

/**
 * Implements an ordered HTML-list &lt;ol&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_ol.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/semantics.html#the-ol-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Ol extends StandardList {

  /**
   * Constructor
   *
   * **Notes:**
   *
   * 1. Any `mixed $items` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   * 2. All items of an array are treated according to note (1)
   *
   * @param  mixed|mixed[]|null $items optional content of the component
   */
  public function __construct($items = null) {
    parent::__construct('ol');
    if ($items !== null) {
      foreach (is_array($items) ? $items : [$items] as $item) {
        $this->append($item);
      }
    }
  }

  /**
   * Sets or unsets the list ordering reversed
   * 
   * @param  boolean $reversed true if the list ordering is reversed, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_ol_reversed.asp reversed attribute
   */
  public function setReversed(bool $reversed = true) {
    $this->attributes()->setAttribute('reversed', $reversed);
    return $this;
  }

  /**
   * Sets the start value of the list ordering index
   * 
   * **Important:** this indexing is independent from the storing offsets of 
   * the {LiInterface} components in the container
   * 
   * @param  int $start the start value of the list ordering index
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_ol_start.asp start attribute
   */
  public function setStart(int $start) {
    $this->attributes()->setAttribute('start', $start);
    return $this;
  }

  /**
   * Returns the start value of the list ordering index
   * 
   * **Important:** this indexing is independent from the storing offsets of 
   * the {LiInterface} components in the container
   * 
   * @return int the start value of the list ordering index (defaults to 1)
   * @link   http://www.w3schools.com/tags/att_ol_start.asp start attribute
   */
  public function getStart(): int {
    $start = 1;
    if ($this->attributes()->isVisible('start')) {
      $start = $this->attributes()->getValue('start');
    }
    return (int) $start;
  }

  /**
   * Sets the kind of marker used in the list
   * 
   * @param  string $type the kind of marker used in the list
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function setListType(string $type = '1') {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the kind of marker used in the list
   * 
   * @return string the kind of marker used in the list
   * @link   http://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function getListType(): string {
    $type = '1';
    if ($this->attributes()->isVisible('type')) {
      $type = $this->attributes()->getValue('type');
    }
    return $type;
  }

}
