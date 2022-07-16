<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Implements an English ordinalizer filter
 *  
 * Adds English ordinal number suffix after normal number
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Ordinalizer extends AbstrectFilter {

  public function filter(mixed $value): string {
    $try = (int) $value;
    if (!in_array(($try % 100), array(11, 12, 13))) {
      switch ($try % 10) {
        // Handle 1st, 2nd, 3rd
        case 1: return $try . 'st';
        case 2: return $try . 'nd';
        case 3: return $try . 'rd';
      }
    }
    return $try . 'th';
  }

}
