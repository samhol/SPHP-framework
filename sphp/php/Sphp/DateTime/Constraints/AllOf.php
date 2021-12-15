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
 * Class AllOf
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AllOf extends AbstractConstraintsAggregate {

  public function isValid(Date $date): bool {
    $valid = true;
    if (!$this->isEmpty()) {
      foreach ($this as $constraint) {
        if (!$constraint->isValid($date)) {
          $valid = false;
          break;
        }
      }
    }
    return $valid;
  }

}
