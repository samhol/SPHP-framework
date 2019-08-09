<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Exceptions\BadMethodCallException;
use Countable;
use Sphp\Stdlib\Arrays;

/**
 * A container for validating a value against multiple validators
 * 
 * @method \Sphp\Validators\Regexp regexp(mixed $content = null, $for = null) inserts a new Regexp validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ValidatorChain extends AbstractValidator implements Countable {

  /**
   * used validators
   *
   * @var Validator[]
   */
  private $validators;

  /**
   * @var bool
   */
  private $breaksOnFailure;

  /**
   * Constructor
   * 
   * @param bool $breaksOnFailure
   * @param string $error
   */
  public function __construct(bool $breaksOnFailure = true, string $error = 'Invalid value') {
    parent::__construct($error);
    $this->validators = [];
    $this->breaksOnFailure = $breaksOnFailure;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->validators);
    parent::__destruct();
  }

  /**
   * Magic call method
   * 
   * @param  string $name
   * @param  array $arguments
   * @return Validator
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments): Validator {
    $validatorClass = '\\Sphp\\Validators\\' . ucfirst($name);
    if (!is_a($validatorClass, Validator::class, true)) {
      throw new BadMethodCallException(sprintf('%s in not a validator', $validatorClass));
    }
    $reflectionClass = new \ReflectionClass($validatorClass);
    $v = $reflectionClass->newInstanceArgs($arguments);
    $this->appendValidators($v);
    return $v;
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->validators = Arrays::copy($this->validators);
    parent::__clone();
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    foreach ($this->validators as $validator) {
      //var_dump($validator);
      if (!$validator->isValid($value)) {
        $valid = false;
        $this->errors()->mergeCollection($validator->errors());
        if ($this->breaksOnFailure) {
          break;
        }
      }
    }
    return $valid;
  }

  /**
   * Appends a new validator(s) to the chain
   * 
   * @param  Validator... $validator new validator(s)
   * @return $this for a fluent interface
   */
  public function appendValidators(Validator... $validator) {
    foreach ($validator as $v) {
      $this->validators[] = $v;
    }
    return $this;
  }

  /**
   * Counts the number of the Validator objects in the chain
   *
   * @return int the number of the Validator objects in the chain
   */
  public function count(): int {
    return count($this->validators);
  }

}
