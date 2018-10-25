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
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LogicalOr extends AbstractValidator {

  /**
   * @var ValidatorInterface
   */
  private $a;

  /**
   * @var ValidatorInterface
   */
  private $b;

  /**
   * Constructor
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
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->a = clone $this->a;
    $this->b = clone $this->b;
  }

  public function getLeftValidator(): Validator {
    return $this->a;
  }

  public function getRightValidator(): Validator {
    return $this->b;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $validA = $this->a->isValid($value);
    $validB = $this->b->isValid($value);
    $valid = $validA || $validB;
    if (!$valid) {
      $this->errors()->mergeCollection($this->a->errors());
      $this->errors()->mergeCollection($this->b->errors());
    }
    return $valid;
  }

}