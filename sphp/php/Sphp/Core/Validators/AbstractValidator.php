<?php

/**
 * AbstractValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Core\I18n\PrioritizedMessageList;
use Sphp\Core\I18n\Message;

/**
 * Abstract superclass for a single value validation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractValidator implements ValidatorInterface {

  /**
   * stores error messages if not valid
   *
   * var PrioritizedMessageList
   */
  private $errors;

  /**
   * Constructs a new {@link self} validator
   *
   * @param MessageList $m container for the error messages
   */
  public function __construct(MessageList $m = null) {
    if ($m === null) {
      $this->errors = new PrioritizedMessageList();
    } else {
      $this->errors = $m;
    }
  }

  /**
   * Adds an error message to the validator
   *
   * @param  string $msg the error message text
   * @param  scalar[] $args arguments
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  protected function createErrorMessage($msg, array $args = [], $priority = 0) {
    //echo "createErrorMessage:$msg";
    $this->errors->insert(new Message($msg, $args), $priority);
    return $this;
  }

  /**
   * Adds an error message to the validator
   *
   * @param  Message $msg the error message text
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  protected function addErrorMessage(Message $msg, $priority = 0) {
    //echo "addErrorMessage:$msg";
    $this->errors->insert($msg, $priority);
    return $this;
  }

  /**
   * Resets the validator to for revalidation
   *
   * @return self for PHP Method Chaining
   */
  public function reset() {
    $this->errors->clearContent();
    return $this;
  }

  public function isValid() {
    return $this->errors->count() == 0;
  }

  public function getErrors() {
    return $this->errors;
  }

  /**
   * Does the validation
   *
   * @param  scalar $value the value to validate
   * @return self for PHP Method Chaining
   */
  public function validate($value) {
    $this->reset()->executeValidation($value);
    return $this;
  }

  /**
   * Executes the actual validation algorithm
   *
   * @param  mixed $value the value to validate
   */
  protected abstract function executeValidation($value);
}
