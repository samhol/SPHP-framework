<?php

/**
 * Ul.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

/**
 * Implements an unordered HTML-list &lt;ul&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @link    http://www.w3schools.com/tags/tag_ul.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Ul extends AbstractList {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * 1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   * 2. All items of an array are treated according to note (1)
   *
   * @param  mixed|null $items the content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($items = null) {
    parent::__construct('ul');
    if ($items !== null) {
      foreach (is_array($items) ? $items : [$items] as $item) {
        $this->append($item);
      }
    }
  }

}
