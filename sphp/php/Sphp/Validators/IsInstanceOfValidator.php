<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Validates data being an object of certain type
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IsInstanceOfValidator extends AbstractValidator {

  /**
   * @var string
   */
  private $className;

  /**
   * Constructor
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
