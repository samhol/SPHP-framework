<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\MySQL;

use Sphp\Database\AbstractInsert;

/**
 * The Replace class
 *
 * REPLACE makes sense only if a table has a PRIMARY KEY or UNIQUE index. 
 * Otherwise, it becomes equivalent to INSERT, because there is no index to be 
 * used to determine whether a new row duplicates another.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Replace extends AbstractInsert {

  public function getQueryString(): string {
    if (!$this->isValid()) {
      throw new InvalidStateException('Statement requires atleast a table name and data');
    }
    $query = "REPLACE INTO $this->table";
    if (!empty($this->names)) {
      $query .= ' (' . implode(', ', $this->names) . ') ';
    }
    return "$query VALUES " . $this->dataToStatement();
  }

}
