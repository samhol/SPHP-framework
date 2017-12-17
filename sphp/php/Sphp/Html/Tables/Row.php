<?php

/**
 * Row.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Interface is the base definition for all HTML &lt;tr&gt; table rows
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Row extends TableContent, \Sphp\Html\TraversableContent {
  

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
   * @param string|null $scope the value of the scope attribute or null for none
   * @param int $colspan solun colspan attribute value
   * @param int $rowspan solun rowspan attribute value
   * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
   * @return Th appended table cell component
   */
  public function appendTh($content, string $scope = null, int $colspan = 1, int $rowspan = 1): Th;

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
   * @param int $colspan the value of the colspan attribute
   * @param int $rowspan the value of the rowspan attribute
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
   * @return $this for a fluent interface
   */
  public function prepend(Cell $cell);
}
