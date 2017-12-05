<?php

/**
 * Delete.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Defines a `DELETE` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Delete extends ConditionalStatement, DataManipulationStatement {

  /**
   * Sets the table from where the data is to be deleted
   *
   * @param  string $table the table
   * @return $this for a fluent interface
   */
  public function from(string $table);
}
