<?php

/**
 * Insert.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Defines an `INSERT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Insert extends DataManipulationStatement {

  /**
   * Sets the database table where to insert the data
   *
   * @param  string $table an existing database table
   * @return $this for a fluent interface
   */
  public function into(string $table);

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  mixed $values
   * @return $this for a fluent interface
   */
  public function values(... $values);

  /**
   * Sets the values that are to be inserted to the table
   *
   * @param  array $values
   * @return $this for a fluent interface
   */
  public function valuesFromCollection(array $values);

  /**
   * Sets the order and the names of the columns in the INSERT data
   *
   * @param  string $name
   * @return $this for a fluent interface
   */
  public function columnNames(string ... $name);
}
