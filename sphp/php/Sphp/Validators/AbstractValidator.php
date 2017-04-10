<?php

/**
 * AbstractValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\I18n\MessageInterface;
use Sphp\I18n\MessageList;
use Sphp\I18n\Message;
use Sphp\I18n\MessageTemplate;

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
  public function __construct() {
    $this->messageTemplates = [];
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
   * @return boolean
   */
  public function __invoke($value) {
    return $this->isValid($value);
  }

  /**
   * 
   * @param  string $id
   * @return MessageTemplate
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
   * @param  string $messageTemplate
   * @return self for a fluent interface
   */
  public function setMessageTemplate($id, MessageTemplate $messageTemplate) {
    $this->messageTemplates[$id] = $messageTemplate;
    return $this;
  }

  /**
   * 
   * @param  array|\Traversable $messageTemplates
   * @return self for a fluent interface
   */
  public function createMessageTemplate($id, $singular, $plural = null) {

    $this->setMessageTemplate($id, new MessageTemplate($singular, $plural));

    return $this;
  }

  /**
   * 
   * @param  array|\Traversable $messageTemplates
   * @return self for a fluent interface
   */
  public function fromMessageTemplate($id, $params = null) {

    $this->addErrorMessage($this->getMessageTemplate($id)->setParams($params)->generate());

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
   * @return self for a fluent interface
   */
  protected function createErrorMessage($msg, array $args = []) {
    $this->errors->insert(new Message($msg, $args));
    return $this;
  }

  /**
   * Adds an error message to the validator
   *
   * @param  Message $msg the error message text
   * @return self for a fluent interface
   */
  protected function addErrorMessage(Message $msg) {
    $this->errors->insert($msg);
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
