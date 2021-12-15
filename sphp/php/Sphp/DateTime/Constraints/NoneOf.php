<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;

/**
 * The NoneOf class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NoneOf extends AbstractConstraintsAggregate {

  public function isValid(Date $date): bool {
    $is = true;
    if (!$this->isEmpty()) {
      foreach ($this as $constraint) {
        if ($constraint->isValid($date)) {
          $is = false;
          break;
        }
      }
    }
    return $is;
  }

}
