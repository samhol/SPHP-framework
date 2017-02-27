<?php

/**
 * AbstractValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

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
  private $value;

  /**
   * Constructs a new validator
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
   * 
   * @return mixed
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * 
   * @param  mixed $value
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    $this->reset();
    $this->value = $value;
    return $this;
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

  public function getErrors() {
    return $this->errors;
  }

}
