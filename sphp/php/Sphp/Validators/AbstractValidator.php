<?php

/**
 * AbstractValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\I18n\MessageInterface;
use Sphp\I18n\Collections\TranslatableCollection;
use Sphp\I18n\Messages\Message;
use Sphp\I18n\Translatable;

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
   * @var TranslatableCollection
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
  public function __construct($error = 'Invalid value') {
    $this->messageTemplates = [];
    $this->errors = new TranslatableCollection();
    $this->setMessageTemplate(static::INVALID, $error);
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
   * @return Message
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
   * @return $this for a fluent interface
   */
  public function setMessageTemplate(string $id, $messageTemplate) {
    if (!$messageTemplate instanceof Translatable) {
      $messageTemplate = Message::singular($messageTemplate);
    }
    $this->messageTemplates[$id] = $messageTemplate;
    return $this;
  }

  /**
   * 
   * @param  mixed $id
   * @param  array $params
   * @return $this for a fluent interface
   */
  public function error(string $id, array $params = []) {
    $this->errors->append($this->getMessageTemplate($id)->setArguments($params));
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
    $this->errors->clearContent();
    return $this;
  }

  public function getErrors(): TranslatableCollection {
    return $this->errors;
  }

}
