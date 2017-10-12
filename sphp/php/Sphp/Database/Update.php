<?php

/**
 * AbstractUpdate.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * An implementation of an SQL UPDATE statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Update extends DataManipulationStatement, ConditionalStatementInterface {

  /**
   * Sets the table(s) which are updated
   *
   * @param  string $table the table to update
   * @return $this for a fluent interface
   */
  public function table(string $table);

  /**
   * Sets the updating data
   *
   * @param  array $data new data
   * @return $this for a fluent interface
   */
  public function set(array $data);
}
