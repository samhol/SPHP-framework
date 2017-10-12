<?php

/**
 * Td.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;table&gt; tag's cell (&lt;td&gt; tag)
 * 
 * This defines a standard cell in a {@link Table} component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Td extends Cell {

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the component
   * @param int $colspan the value of the colspan attribute
   * @param int $rowspan the value of the rowspan attribute
   * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
   */
  public function __construct($content = null, int $colspan = 1, int $rowspan = 1) {
    parent::__construct('td', $content);
    $this->setColspan($colspan);
    $this->setRowspan($rowspan);
  }

}
