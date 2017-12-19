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
 * Abstract superclass for miscellaneous data validation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractValidator implements ValidatorInterface {

  /**
   * `ID` for default error message
   */
  const INVALID = '_invalid_';

  /**
   * stores error messages if not valid
   *
   * @var TranslatableCollection
   */
  private $errors;

  /**
   * @var MessageInterface[] 
   */
  private $messageTemplates = [];

  /**
   * @var mixed 
   */
  private $value;

  /**
   * Constructs a new validator
   *
   * @param string $error error message
   */
  public function __construct(string $error = 'Invalid value') {
    $this->messageTemplates = [];
    $this->errors = new TranslatableCollection();
    $this->setMessageTemplate(static::INVALID, $error);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->messageTemplates, $this->errors, $this->value);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
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
  public function getMessageTemplate(string $id) {
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
   * Sets the error message 
   * 
   * @param  string $id the id of the message
   * @param  array $params optional message parameters
   * @return $this for a fluent interface
   */
  public function error(string $id, array $params = []) {
    $this->errors->append($this->getMessageTemplate($id)->setArguments($params));
    return $this;
  }

  /**
   * Returns validated value 
   * 
   * @return mixed validated value 
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Sets the validated value
   * 
   * @param  mixed $value the validated value
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
