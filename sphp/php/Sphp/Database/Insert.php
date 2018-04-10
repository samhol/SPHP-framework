<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

/**
 * Defines an `INSERT` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
  public function valuesFromArray(array $values);

  /**
   * Sets the order and the names of the columns in the INSERT data
   *
   * @param  string $name
   * @return $this for a fluent interface
   */
  public function columnNames(string ... $name);
}
