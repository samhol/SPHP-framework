<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Abstract superclass for an optional validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class OptionalValidator extends ValidatorChain {

  /**
   * whether empty values are allowed or not
   *
   * @var boolean
   */
  private $allowEmptyValues = true;

  /**
   * Constructs a new instance
   * 
   * @param boolean $allowEmptyValues
   */
  public function __construct(bool $allowEmptyValues = true) {
    parent::__construct();
    $this->allowEmptyValues($allowEmptyValues);
  }

  /**
   * Sets/unsets validation for empty values
   *
   * @param  boolean $allow true if all values are validated and false if not
   * @return $this for a fluent interface
   */
  public function allowEmptyValues(bool $allow = true) {
    $this->allowEmptyValues = $allow;
    return $this;
  }

  /**
   * Checks if empty values are validated or not
   *
   * @return boolean true if empty values are validated and false if not
   */
  public function emptyValuesAllowed(): bool {
    return $this->allowEmptyValues;
  }

}
