<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Col extends EmptyTag implements TableContent {

  /**
   * Constructor
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
      return $this->setAttribute('span', $value);
    } else {
      return $this->removeAttribute('span');
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
    $span = (int) $this->getAttribute('span');
    return $span > 1 ? $span : 1;
  }

}
