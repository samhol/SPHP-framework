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
class ArrayFilter {

  /**
   *
   * @var EntryFilter 
   */
  private $validator;

  public function __construct(EntryFilter $entryValidator = null) {
    if ($entryValidator === null) {
      $entryValidator = new EntryFilter();
    }
    $this->validator = $entryValidator;
  }

  /**
   * Adds a filter to the aggregate
   * 
   * @param  callable $filter a filter to add
   * @return $this for a fluent interface
   */
  public function addEntryRule(callable $filter) {
    $this->validator->addRule($filter);
    return $this;
  }

  public function __invoke(array $array): array {
    return $this->filter($array);
  }

  public function filter(array $array): array {
    return array_filter($array, $this->validator);
  }

}
