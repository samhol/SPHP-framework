<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection;

use ReflectionExtension;

/**
 * Reports information about an extension
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExtensionReflector extends ReflectionExtension implements Reflector {

  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns an array of class reflectors within the extension
   * 
   * @return array<string, ClassReflector> an associative array of class reflectors
   */
  public function getClasses(): array {
    $result = [];
    foreach ($this->getClassNames() as $class) {
      $result[$class] = new ClassReflector($class);
    }
    return $result;
  }

  /**
   * Returns an array of constant reflectors within the extension
   * 
   * @return array<string, ConstantReflector> aAn associative array of constant reflectors
   */
  public function getReflectionConstants(): array {
    $result = [];
    foreach (array_keys($this->getConstants()) as $name) {
      $result[$name] = new ConstantReflector($name);
    }
    return $result;
  }

  /**
   * 
   * @return array<string, FunctionReflector> An associative array of functions
   */
  public function getFunctions(): array {
    $result = [];
    foreach (array_keys(parent::getFunctions()) as $name) {
      $result[$name] = new FunctionReflector($name);
    }
    return $result;
  }

}
