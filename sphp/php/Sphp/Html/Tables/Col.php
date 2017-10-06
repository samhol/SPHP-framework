<?php

/**
 * Col.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;col&gt; tag
 *
 * The &lt;col&gt; tag specifies column properties for each column within a
 * &lt;colgroup&gt; element. The &lt;col&gt; tag is useful for applying styles
 * to entire columns, instead of repeating the styles for each cell, for each
 * row.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-01-03
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Col extends EmptyTag implements TableContentInterface {

  /**
   * Constructs a new instance
   *
   * @precondition `$span > 0`
   * @param int $span specifies the number of columns a col element should span
   * @link  http://www.w3schools.com/tags/att_col_span.asp span attribute
   */
  public function __construct(int $span = 1) {
    parent::__construct('col');
    $this->setSpan($span);
  }

  /**
   * Sets the value of the span attribute
   *
   * **Note:** The span attribute specifies the number of columns a col
   * element should span.
   *
   * @precondition `$span > 0`
   * @param  int $value the value of the span attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_col_span.asp span attribute
   */
  public function setSpan(int $value) {
    if ($value >= 2) {
      return $this->setAttr('span', $value);
    } else {
      return $this->removeAttr('span');
    }
  }

  /**
   * Returns the value of the span attribute
   *
   * **Note:** The span attribute specifies the number of columns a col
   * element should span.
   *
   * @return int the value of the span attribute
   * @link   http://www.w3schools.com/tags/att_col_span.asp href attribute
   */
  public function getSpan(): int {
    $span = (int) $this->getAttr('span');
    return $span > 1 ? $span : 1;
  }

}
