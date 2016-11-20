<?php

/**
 * AbstractValidatorAggregate.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Countable;
use IteratorAggregate;
use Sphp\Data\Collection;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractValidatorAggregate extends AbstractOptionalValidator implements Countable, IteratorAggregate {

  /**
   * used validators
   *
   * @var Collection
   */
  protected $validators;

  /**
   * Constructs a new validator
   *
   * @param ValidatorInterface|ValidatorInterface[] $validators used
   */
  public function __construct($validators = null) {
    parent::__construct();
    $this->validators = new Collection();
    if (is_array($validators)) {
      foreach ($validators as $validator) {
        $this->appendValidator($validator);
      }
    } else if ($validators instanceof ValidatorInterface) {
      $this->appendValidator($validators);
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
  protected function executeValidation($value) {
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
  protected function appendValidator(ValidatorInterface $v) {
    $this->validators[] = $v;
    return $this;
  }

  /**
   * Assigns a validator to the specified offset
   *
   * @param  mixed $offset the offset to assign the validator to
   * @param  ValidatorInterface $validator validator object
   * @return self for PHP Method Chaining
   */
  protected function set($offset, ValidatorInterface $validator) {
    $this->validators->offsetSet($offset, $validator);
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
   * @return Collection iterator
   */
  public function getIterator() {
    return $this->validators;
  }

}
