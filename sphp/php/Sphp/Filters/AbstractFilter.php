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
 * An abstract implementation of a filter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractFilter implements Filter {

  /**
   * Executes the filter when the filter object is called as a function
   * 
   * @param  mixed $variable the data to filter
   * @return mixed the filtered value
   */
  public function __invoke(mixed $value): mixed {
    return $this->filter($value);
  }

}
