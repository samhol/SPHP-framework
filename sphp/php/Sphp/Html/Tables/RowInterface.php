<?php

/**
 * RowInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Interface is the base definition for all {@link TableRowContainer} content rows
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-04
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RowInterface extends TableContentInterface {

  /**
   * Sets the default type of the table cells
   * 
   * @param  string $defaultCell the default type of the cell `td|th`
   * @return self for PHP Method Chaining
   */
  public function setDefaultCellType($defaultCell);

  /**
   * Sets the default type of the table cells
   * 
   * @return string the default type of the cell `td|th`
   */
  public function getDefaultCellType();
}
