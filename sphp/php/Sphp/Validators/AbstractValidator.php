<?php

/**
 * AbstractValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Core\I18n\MessageInterface;
use Sphp\Core\I18n\MessageList;
use Sphp\Core\I18n\Message;

/**
 * Abstract superclass for validation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractValidator implements ValidatorInterface {

  const INVALID = '_invalid_';

  /**
   * stores error messages if not valid
   *
   * @var MessageList
   */
  private $errors;

  /**
   *
   * @var MessageInterface[] 
   */
  private $messageTemplates = [];

  /**
   *
   * @var mixed 
   */
  private $value;

  /**
   * Constructs a new validator
   *
   * @param MessageList $m container for the error messages
   */
  public function __construct(array $messageTemplates = []) {
    $this->messageTemplates = $messageTemplates;
    $this->errors = new MessageList();
  }

  public function __destruct() {
    unset($this->messageTemplates, $this->errors, $this->value);
  }

  public function __clone() {
    $this->errors = clone $this->errors;
    $this->messageTemplates = clone $this->messageTemplates;
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
   * 
   * @param  string $id
   * @return MessageInterface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the template does not exist
   */
  public function getMessageTemplate($id) {
    if (!array_key_exists($id, $this->messageTemplates)) {
      throw new \Sphp\Exceptions\InvalidArgumentException("Template with id: '$id' does not exist");
    }
    return $this->messageTemplates[$id];
  }

  /**
   * 
   * @param  string $id
   * @param  string|MessageInterface $messageTemplate
   * @return self for a fluent interface
   */
  public function setMessageTemplate($id, $messageTemplate) {
    if (is_string($messageTemplate)) {
      $messageTemplate = new Message($messageTemplate);
    }
    $this->messageTemplates[$id] = $messageTemplate;
    return $this;
  }

  /**
   * 
   * @param  array|\Traversable $messageTemplates
   * @return self for a fluent interface
   */
  public function setMessageTemplates($messageTemplates) {
    foreach ($messageTemplates as $id => $messageTemplate) {
      $this->setMessageTemplate($id, $messageTemplate);
    }
    return $this;
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
   * @return self for a fluent interface
   */
  public function setValue($value) {
    $this->reset();
    $this->value = $value;
    return $this;
  }

  /**
   * Adds an error message to the validator
   *
   * @param  string $msg the error message text
   * @param  scalar[] $args arguments
   * @param  int $priority the priority of the message
   * @return self for a fluent interface
   */
  protected function createErrorMessage($msg, array $args = [], $priority = 0) {
    $this->errors->insert(new Message($msg, $args), $priority);
    return $this;
  }

  /**
   * Adds an error message to the validator
   *
   * @param  Message $msg the error message text
   * @param  int $priority the priority of the message
   * @return self for a fluent interface
   */
  protected function addErrorMessage(Message $msg, $priority = 0) {
    $this->errors->insert($msg, $priority);
    return $this;
  }

  /**
   * Resets the validator to for revalidation
   *
   * @return self for a fluent interface
   */
  public function reset() {
    $this->errors->clearContent();
    return $this;
  }

  public function getErrors() {
    return $this->errors;
  }

}
