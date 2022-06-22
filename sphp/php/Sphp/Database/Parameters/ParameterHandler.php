<?php

declare(strict_types=1);
/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Parameters;

use PDOStatement;
use Traversable;
use Countable;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * Defines a parameter handler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ParameterHandler extends Traversable, Countable {

  /**
   * Checks whether the handler contains parameters
   * 
   * @return bool true if the handler contains parameters, false otherwise
   */
  public function isEmpty(): bool;

  /**
   * Binds the managed parameters to the given statement
   * 
   * @param  PDOStatement $statement the statement object
   * @return voidt
   * @throws DatabaseException if the binding fails
   * @link   https://www.php.net/manual/en/class.pdostatement.php The PDOStatement class
   */
  public function bindTo(PDOStatement $statement): void;
}
