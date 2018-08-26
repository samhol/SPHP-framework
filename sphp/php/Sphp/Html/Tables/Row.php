<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\TraversableContent;

/**
 * Interface is the base definition for all HTML &lt;tr&gt; table rows
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Row extends TableContent, TraversableContent {

  /**
   * Appends a cell component to the row
   *
   * @param  Cell $cell new cell object
   * @return $this for a fluent interface
   */
  public function append(Cell $cell);

  /**
   * Creates and appends a new &lt;th&gt; component to the row
   *
   * @precondition  $scope == row|col|rowgroup|colgroup
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the tag
   * @param int $colspan specifies the number of columns cell should span
   * @param int $rowspan specifies the number of rows cell should span
   * @param string|null $scope the value of the scope attribute or null for none
   * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
   * @return Th appended table cell component
   */
  public function appendTh($content, int $colspan = 1, int $rowspan = 1, string $scope = null): Th;

  /**
   * Creates and appends &lt;th&gt; components to the row
   *
   * @param  mixed[] $cells cells of the table row
   * @return $this for a fluent interface
   */
  public function appendThs(array $cells);

  /**
   * Creates and appends a new &lt;td&gt; component to the row
   *
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the component
   * @param int $colspan specifies the number of columns cell should span
   * @param int $rowspan specifies the number of rows cell should span
   * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
   * @return Td appended table cell component
   */
  public function appendTd($content, int $colspan = 1, int $rowspan = 1): Td;

  /**
   * Creates and appends &lt;td&gt; components to the row
   *
   * @param  mixed[] $cells cells of the table row
   * @return $this for a fluent interface
   */
  public function appendTds(array $cells);

  /**
   * Prepends a cell component to the row
   *
   * @param  Cell $cell new cell object
   * @return Cell prepended table cell component
   */
  public function prepend(Cell $cell);

  /**
   * Returns the cell at given position
   * 
   * **Important:** Cells are numbered sequentially starting from 0
   * 
   * @param  int $number
   * @return Row the row at given position
   * @throws OutOfBoundsException
   */
  public function getCell(int $number): Cell;
}
