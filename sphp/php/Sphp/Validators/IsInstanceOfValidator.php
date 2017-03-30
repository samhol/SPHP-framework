<?php

/**
 * IsInstanceOfValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of IsInstanceOfValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IsInstanceOfValidator extends AbstractValidator {

  /**
   *
   * @var string
   */
  private $className;

  public function __construct($className, $messageTemplates = array()) {
    parent::__construct($messageTemplates);
    $this->setClassName($className);
  }

  public function getClassName() {
    return $this->className;
  }

  /**
   * 
   * @param  object|string $className
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setClassName($className) {
    if (is_object($className)) {
      $className = get_class($className);
    } else if (!is_string($className)) {
      throw new InvalidArgumentException("Invalid class name parameter");
    }
    $this->className = $className;
    return $this;
  }

  public function isValid($value) {
    $this->setValue($value);
    if ($value instanceof $this->className) {
      return true;
    }
    $this->createErrorMessage('blaa');
    return false;
  }

}
