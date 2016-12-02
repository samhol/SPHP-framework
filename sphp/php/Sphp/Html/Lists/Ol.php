<?php

/**
 * Ol.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

/**
 * Class models an ordered HTML-list &lt;ol&gt; tag
 *
 * {@inheritdoc}
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @link    http://www.w3schools.com/tags/tag_ol.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/semantics.html#the-ol-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Ol extends HtmlList {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * 1. Any `mixed $items` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   * 2. All items of an array are treated according to note (1)
   *
   * @param  mixedmixed[]|null $items optional content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_ol_reversed.asp reversed attribute
   */
  public function setReversed($reversed = true) {
    $this->attrs()->set('reversed', (bool) $reversed);
    return $this;
  }

  /**
   * Sets the start value of the list ordering index
   * 
   * **Important:** this indexing is independent from the storing offsets of 
   * the {LiInterface} components in the container
   * 
   * @param  int $start the start value of the list ordering index
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_ol_start.asp start attribute
   */
  public function setStart($start) {
    $this->attrs()->set("start", $start);
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
  public function getStart() {
    $start = 1;
    if ($this->attrs()->exists("start")) {
      $start = $this->attrs()->get("start");
    }
    return (int) $start;
  }

  /**
   * Sets the kind of marker used in the list
   * 
   * @param  string $type the kind of marker used in the list
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function setType($type = "1") {
    $this->attrs()->set("type", $type);
    return $this;
  }

  /**
   * Returns the kind of marker used in the list
   * 
   * @return string the kind of marker used in the list
   * @link   http://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function getType() {
    $type = "1";
    if ($this->attrs()->exists("type")) {
      $type = $this->attrs()->get("type");
    }
    return $type;
  }

}
