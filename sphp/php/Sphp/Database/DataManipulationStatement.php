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
 * Defines basic methods for database data manipulation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface DataManipulationStatement extends Statement {

  /**
   * Executes the data manipulation SQL statement, returning the number of affected rows
   *
   * @return int the number of affected rows
   * @throws \PDOException if there is no database connection or query execution fails
   */
  public function affectRows(): int;
}
