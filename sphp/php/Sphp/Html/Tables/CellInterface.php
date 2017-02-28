<?php

/**
 * CellInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
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
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-04
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-td-element W3C API
 * @link    http://www.w3schools.com/tags/tag_th.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-th-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CellInterface extends TableContentInterface {

  /**
   * Sets the value of the colspan attribute
   *
   * **Note:** Only Firefox and Opera support colspan="0", which tells the 
   *  browser to span the cell to the last column of the column group 
   * (colgroup).
   *
   * @precondition  $value >= 1
   * @param  int $value the value of the colspan attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_td_colspan.asp td colspan attribute
   * @link   http://www.w3schools.com/tags/att_th_colspan.asp th colspan attribute
   */
  public function setColspan($value);

  /**
   * Returns the value of the colspan attribute
   *
   * @return int the value of the colspan attribute
   * @link   http://www.w3schools.com/tags/att_td_colspan.asp td colspan attribute
   * @link   http://www.w3schools.com/tags/att_th_colspan.asp th colspan attribute
   */
  public function getColspan();

  /**
   * Sets the value of the rowspan attribute
   *
   * **Note:** Only Firefox and Opera support rowspan="0", which tells the 
   *  browser to span the cell to the last row of the table section 
   *  (thead, tbody, or tfoot).
   *
   * @precondition  $value >= 1
   * @param  int $value the value of the rowspan attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_td_rowspan.asp td rowspan attribute
   * @link   http://www.w3schools.com/tags/att_th_rowspan.asp th rowspan attribute
   */
  public function setRowspan($value);

  /**
   * Returns the value of the rowspan attribute
   *
   * @return int the value of the rowspan attribute
   * @link   http://www.w3schools.com/tags/att_td_rowspan.asp td rowspan attribute
   * @link   http://www.w3schools.com/tags/att_th_rowspan.asp th rowspan attribute
   */
  public function getRowspan();
}
