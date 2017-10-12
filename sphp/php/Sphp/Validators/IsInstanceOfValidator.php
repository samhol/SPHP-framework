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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IsInstanceOfValidator extends AbstractValidator {

  /**
   * @var string
   */
  private $className;

  /**
   * Constructs a new instance
   * 
   * @param string $className
   */
  public function __construct(string $className) {
    parent::__construct('Value is not instance of %s');
    $this->setClassName($className);
  }

  /**
   * Returns the class name
   * 
   * @return string class name
   */
  public function getClassName(): string {
    return $this->className;
  }

  /**
   * 
   * @param  string $className the name of the class 
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the class is not defined
   */
  public function setClassName(string $className) {
    if (!class_exists($className)) {
      throw new InvalidArgumentException('Invalid class name parameter');
    }
    $this->className = $className;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($value instanceof $this->className) {
      return true;
    }
    $this->error(self::INVALID, [$this->className]);
    return false;
  }

}
