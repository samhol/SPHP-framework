<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates a value using (inclusive) disjunction of two validators 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LogicalOr extends AbstractValidator {

  private Validator $a;
  private Validator $b;

  /**
   * Constructor
   *
   * @param Validator $a
   * @param Validator $b
   */
  public function __construct(Validator $a, Validator $b) {
    $this->a = $a;
    $this->b = $b;
    parent::__construct();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->a, $this->b);
    parent::__destruct();
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->a = clone $this->a;
    $this->b = clone $this->b;
    parent::__clone();
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $validA = $this->a->isValid($value);
    $validB = $this->b->isValid($value);
    $valid = $validA || $validB;
    if (!$valid) {
      $this->getErrors()->mergeCollection($this->a->getErrors());
      $this->getErrors()->mergeCollection($this->b->getErrors());
    }
    return $valid;
  }

}
