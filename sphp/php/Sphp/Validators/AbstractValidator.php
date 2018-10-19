<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Stdlib\Arrays;

/**
 * Abstract superclass for miscellaneous data validation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractValidator implements ValidatorInterface {

  /**
   * stores error messages if not valid
   *
   * @var string[]
   */
  private $errors;

  /**
   * @var string[] 
   */
  private $messageTemplates = [];

  /**
   * @var mixed 
   */
  private $value;

  /**
   * Constructor
   *
   * @param string $error error message
   */
  public function __construct(string $error = 'Invalid value') {
    $this->messageTemplates = [];
    $this->errors = [];
    $this->setMessageTemplate(static::INVALID, $error);
  }

  /**
   * Destructor
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
    $this->errors = Arrays::copy($this->errors);
    $this->messageTemplates = Arrays::copy($this->messageTemplates);
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
   * @return string
   * @throws \Sphp\Exceptions\InvalidArgumentException if the template does not exist
   */
  public function getMessageTemplate(string $id): string {
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
  public function setMessageTemplate(string $id, string $messageTemplate) {
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
  public function errorFromTemplate(string $id, array $params = []) {
    $this->errors[] = vsprintf($this->getMessageTemplate($id), $params);
    return $this;
  }

  /**
   * Sets the error message 
   * 
   * @param  string $message the id of the message
   * @return $this for a fluent interface
   */
  public function error(string $message) {
    $this->errors[] = $message;
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
    $this->errors = [];
    return $this;
  }

  public function getErrors(): array {
    return $this->errors;
  }

}
