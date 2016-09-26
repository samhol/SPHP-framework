<?php

/**
 * ValueValidatorAggregate.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Util\SphpArrayObject as SphpArrayObject;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ValueValidatorAggregate extends AbstractOptionalValidator implements \Countable, \IteratorAggregate {

  /**
   * used validators
   *
   * @var ArrayObject[ValidatorInterface]
   */
  private $validators;

  /**
   * Constructs a new {@link ValueValidatorAggregate} object
   *
   * @param ValidatorInterface|ValidatorInterface[] $validators used
   */
  public function __construct($validators = null) {
    parent::__construct();
    $this->validators = new SphpArrayObject();
    if (is_array($validators)) {
      foreach ($validators as $validator) {
        $this->addValidator($validator);
      }
    } else if ($validators instanceof ValidatorInterface) {
      $this->addValidator($validators);
    }
  }

  /**
   * Does the actual validation
   *
   *  Executed only if the <var>$value</var> is either non empty or empty
   *  values are set to be validated.
   *
   * @param  scalar $value the value to validate
   * @return self for PHP Method Chaining
   */
  public function executeValidation($value) {
    //echo "t4g4ge";
    foreach ($this as $validator) {
      $validator->validate($value);
      //var_dump($value);
      if (!$validator->isValid()) {
        //echo get_class($validator);
        //echo $validator->getErrors();
        //echo $this->getErrors();
        foreach ($validator->getErrors() as $err) {
          $this->addErrorMessage($err);
        }
        //echo "a:::".$a;
        //echo "this:::".$this->getErrors();
      }
    }
    return $this;
  }

  /**
   * Adds a new {@link ValidatorInterface} object to the aggregate.
   *
   * @param ValidatorInterface $v new validator object
   * @return self for PHP Method Chaining
   */
  public function addValidator(ValidatorInterface $v) {
    $this->validators[] = $v;
    return $this;
  }

  /**
   * Sets empty value validation on or off
   *
   * **Note**: Sets this attribute for all validators extending
   *  {@link OptionalValueValidator} stored into the aggregate.
   *
   * @param  boolean $forced true if empty values are validated and false if not
   * @return self for PHP Method Chaining
   */
  public function setAllForced($forced = true) {
    foreach ($this as $validator) {
      if ($validator instanceof AbstractOptionalValidator) {
        $validator->forceValidation($forced);
      }
    }
    $this->forceValidation($forced);
    return $this;
  }

  /**
   * Counts the number of the {@link ValidatorInterface} objects in aggregate
   *
   * @return int the number of the {@link ValidatorInterface} objects
   */
  public function count() {
    return $this->validators->count();
  }

  /**
   * Create a new iterator to iterate through the {@link ValidatorInterface}
   * objects in the aggregate
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return new \ArrayIterator($this->validators);
  }

}
