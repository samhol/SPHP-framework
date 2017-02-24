<?php

/**
 * ValidatorAggregate.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Countable;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ValidatorAggregate extends AbstractValidator implements Countable {

  /**
   * used validators
   *
   * @var mixed[]
   */
  protected $validators;

  /**
   * Constructs a new validator
   */
  public function __construct() {
    parent::__construct();
    $this->validators = [];
  }

  protected function executeValidation($value) {
    //echo "t4g4ge $value";
    $valid = true;
    foreach ($this->validators as $validator) {
      $v = $validator['validator'];
      $break = $validator['break'];
      //var_dump($value);
      if (!$v->isValid($value)) {
        $valid = false;
        //echo get_class($v) . "($value)\n";
        //echo $v->getErrors();
        //echo $this->getErrors();
        $this->getErrors()->merge($v->getErrors());
        //echo "a:::".$a;
        //echo "this:::".$this->getErrors();

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
   * @param ValidatorInterface $v new validator object
   * @return self for PHP Method Chaining
   */
  /**
   * Appends a new validator to the chain
   * 
   * @param  ValidatorInterface $v new validator object
   * @param  boolean $break
   * @return self for PHP Method Chaining
   */
  public function appendValidator(ValidatorInterface $v, $break = false) {
    $data = [
        'validator' => $v,
        'break' => (bool) $break,
    ];
    $this->validators[] = $data;
    return $this;
  }

  /**
   * Counts the number of the {@link ValidatorInterface} objects in the chain
   *
   * @return int the number of the {@link ValidatorInterface} objects
   */
  public function count() {
    return count($this->validators);
  }

}
