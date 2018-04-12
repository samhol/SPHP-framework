<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Interface is the base definition for all {@link Tr} content (table cells)
 * 
 * An HTML table has two kinds of cells:
 *
 *  **Header cells** - contains header information (created with the &lt;th&gt; element).
 *  The text in &lt;th&gt; elements are bold and centered by default.
 * 
 *  **Standard cells** - contains data (created with the &lt;td&gt; element).
 *  The text in &lt;td&gt; elements are regular and left-aligned by default.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-td-element W3C API
 * @link    http://www.w3schools.com/tags/tag_th.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-th-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Cell extends TableContent {

  /**
   * Sets the value of the colspan attribute
   *
   * **Note:** Only Firefox and Opera support colspan="0", which tells the 
   *  browser to span the cell to the last column of the column group 
   * (colgroup).
   *
   * @precondition  $value >= 1
   * @param  int $value the value of the colspan attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_td_colspan.asp td colspan attribute
   * @link   http://www.w3schools.com/tags/att_th_colspan.asp th colspan attribute
   */
  public function setColspan(int $value);

  /**
   * Returns the value of the colspan attribute
   *
   * @return int the value of the colspan attribute
   * @link   http://www.w3schools.com/tags/att_td_colspan.asp td colspan attribute
   * @link   http://www.w3schools.com/tags/att_th_colspan.asp th colspan attribute
   */
  public function getColspan(): int;

  /**
   * Sets the value of the rowspan attribute
   *
   * **Note:** Only Firefox and Opera support rowspan="0", which tells the 
   *  browser to span the cell to the last row of the table section 
   *  (thead, tbody, or tfoot).
   *
   * @precondition  $value >= 1
   * @param  int $value the value of the rowspan attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_td_rowspan.asp td rowspan attribute
   * @link   http://www.w3schools.com/tags/att_th_rowspan.asp th rowspan attribute
   */
  public function setRowspan(int $value);

  /**
   * Returns the value of the rowspan attribute
   *
   * @return int the value of the rowspan attribute
   * @link   http://www.w3schools.com/tags/att_td_rowspan.asp td rowspan attribute
   * @link   http://www.w3schools.com/tags/att_th_rowspan.asp th rowspan attribute
   */
  public function getRowspan(): int;
}
