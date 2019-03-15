<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters\Arrays;

/**
 * Description of ArrayFilter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EntryFilter {

  private $rules;

  public function __construct() {
    $this->rules = [];
  }

  /**
   * Adds a filter to the aggregate
   * 
   * @param  callable $filter a filter to add
   * @return $this for a fluent interface
   */
  public function addRule(callable $filter) {
    $this->rules[] = $filter;
    return $this;
  }

  public function __invoke($value, $key = null) {
    $this->validateEntry($value, $key);
  }

  public function validateEntry($value, $key = null): bool {
    $valid = true;
    foreach ($this->rules as $rule) {
      $valid = $rule($value, $key);
      if (!$valid) {
        break;
      }
    }
    return $valid;
  }

}
