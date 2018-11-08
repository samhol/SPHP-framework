<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Countable;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ValidatorChain extends AbstractValidator implements Countable {

  /**
   * used validators
   *
   * @var mixed[]
   */
  private $validators;

  /**
   * Constructor
   * 
   * @param string $error error message template
   */
  public function __construct(string $error = 'Invalid value') {
    parent::__construct($error);
    $this->validators = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->validators);
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
    $this->validators = \Sphp\Stdlib\Arrays::copy($this->validators);
    parent::__clone();
  }

  public function setValue($value) {
    parent::setValue($value);
    foreach ($this->validators as $validator) {
      
    }
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    foreach ($this->validators as $validator) {
      $v = $validator['validator'];
      $break = $validator['break'];
      if (!$v->isValid($value)) {
        $valid = false;
        $this->errors()->mergeCollection($v->errors());
        if ($break) {
          break;
        }
      }
    }
    return $valid;
  }

  /**
   * Appends a new validator to the chain
   * 
   * @param  Validator $v new validator object
   * @param  boolean $break
   * @return $this for a fluent interface
   */
  public function appendValidator(Validator $v, bool $break = false) {
    $data = [
        'validator' => $v,
        'break' => (bool) $break,
    ];
    $this->validators[] = $data;
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
