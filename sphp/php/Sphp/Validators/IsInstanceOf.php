<?php

declare(strict_types=1);

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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IsInstanceOf extends AbstractValidator {

  /**
   * @var string
   */
  private $className;

  /**
   * Constructor
   * 
   * @param string $className
   * @param string $error
   * @throws InvalidArgumentException if the class or interface is not defined
   */
  public function __construct(string $className, string $error = 'Value is not instance of %s') {
    parent::__construct($error);
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
   * Sets the name of the correct class or interface 
   * 
   * @param  string $className the name of the class 
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the class or interface is not defined
   */
  public function setClassName(string $className) {
    if (!class_exists($className) && !interface_exists($className)) {
      throw new InvalidArgumentException('Invalid class or interface name: ' . $className);
    }
    $this->className = $className;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($value instanceof $this->className) {
      return true;
    }
    $this->errors()->appendErrorFromTemplate(self::INVALID, [$this->className]);
    return false;
  }

}
