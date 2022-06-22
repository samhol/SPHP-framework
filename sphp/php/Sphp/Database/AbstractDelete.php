<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Database\Exceptions\InvalidStateException;

/**
 * An abstract implementation of a `DELETE` statement
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractDelete extends AbstractConditionalStatement implements Delete {

  /**
   * the target table
   */
  private string $table;

  /**
   * Sets the table from where the data is to be deleted
   *
   * @param  string $table the table
   * @return $this for a fluent interface
   */
  public function from(string $table) {
    $this->table = $table;
    return $this;
  }

  public function isValid(): bool {
    return isset($this->table);
  }

  public function getQueryString(): string {
    if (!$this->isValid()) {
      throw new InvalidStateException('DELETE query requires atleast a table name');
    }
    $out = "DELETE FROM $this->table";
    if ($this->where->notEmpty()) {
      $out .= " $this->where";
    }
    return $out;
  }

  public function affectRows(): int {
    return $this->execute()->rowCount();
  }

}
