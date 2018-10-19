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
class LogicalOr extends AbstractLogicalValidator {

  /**
   * @var ValidatorInterface
   */
  private $a;

  /**
   * @var ValidatorInterface
   */
  private $b;

  /**
   * @var string[]
   */
  private $errors;

  /**
   * Constructor
   */
  public function __construct(ValidatorInterface $a, ValidatorInterface $b) {
    $this->a = $a;
    $this->b = $b;
    $this->errors = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->a, $this->b, $this->errors);
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

  /**
   * Invoke validator as command
   *
   * @param  mixed $value
   * @return bool
   */
  public function __invoke($value) {
    return $this->isValid($value);
  }

  public function getErrors(): array {
    return $this->errors;
  }

  /**
   * Sets the validated value
   * 
   * @param  mixed $value the validated value
   * @return $this for a fluent interface
   */
  public function setValue($value) {
    $this->reset();
    $this->value = $value;
    return $this;
  }

  /**
   * Resets the validator to for revalidation
   *
   * @return $this for a fluent interface
   */
  public function reset() {
    $this->errors = [];
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $validA = $this->a->isValid($value);
    $validB = $this->b->isValid($value);
    $valid = $validA || $validB;
    if (!valid) {
      $this->errors = array_merge($this->a->getErrors(), $this->b->getErrors());
    }
    return $valid;
  }

}
