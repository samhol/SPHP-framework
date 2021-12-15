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
 * Class OneOf
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AnyOf extends AbstractConstraintsAggregate {

  public function isValid(Date $date): bool {
    $isValid = $this->isEmpty();
    if (!$isValid) {
      foreach ($this as $constraint) {
        $isValid = $constraint->isValid($date);
        if ($isValid) {
          break;
        }
      }
    }
    return $isValid;
  }

}
