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

use Traversable;

/**
 * An aggregate of filters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ArrayFilter extends FilterAggregate {

  private bool $useKeys = false;

  public function useKeys(bool $use) {
    $this->useKeys = $use;
    return $this;
  }

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  public function filter(mixed $value, mixed ... $params): mixed {
    if (is_array($value)) {

      $f = function (&$val, $key) {
        $val = parent::filter($val, $key);
        //return $val;
      };
      array_walk($value, $f);
    }
    return $value;
  }

}
