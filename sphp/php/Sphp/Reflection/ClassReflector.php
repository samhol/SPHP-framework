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

use ReflectionClass;

/**
 * Reflection class that reports information about a class
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassReflector extends ReflectionClass implements ExtensionReflectable {

  use Traits\ExtensionReflectorTrait;

  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the abstraction type of the reflected class
   * 
   * @return string the abstraction type of the reflected class
   */
  public function getModifierNames(): string {
    if ($this->isInterface()) {
      $type = 'interface';
    } else if ($this->isTrait()) {
      $type = 'trait';
    } else if ($this->isAbstract()) {
      $type = 'abstract class';
    } else if ($this->isFinal()) {
      $type = 'final class';
    } else {
      $type = 'class';
    }
    return $type;
  }

  /**
   * Returns the constructor of the class
   * 
   * @return MethodReflector|null
   */
  public function getConstructor(): ?MethodReflector {
    $constructor = null;
    if ($this->hasMethod('__construct')) {
      $constructor = new MethodReflector($this->getName(), '__construct');
    }
    return $constructor;
  }

  public function getExtensionName(): ?string {
    $name = parent::getExtensionName();
    if (!is_string($name)) {
      $name = null;
    }
    return $name;
  }

  public function hasParentClass(): bool {
    return parent::getParentClass() !== false;
  }

  public function getParentClass(): ?ClassReflector {
    $result = null;
    $parentRef = parent::getParentClass();
    if ($parentRef !== false) {
      $result = new ClassReflector($parentRef->name);
    }
    return $result;
  }

  /**
   * Returns the interfaces
   * 
   * @return array<string, ClassReflector> An associative array of interfaces
   */
  public function getInterfaces(): array {
    $result = [];
    foreach (parent::getInterfaceNames() as $interface) {
      $result[$interface] = new ClassReflector($interface);
    }
    return $result;
  }

  /**
   * 
   * @param  string $name the name of the method
   * @return MethodReflector|null
   */
  public function getMethod($name): ?MethodReflector {
    $instance = null;
    if ($this->hasMethod($name)) {
      $instance = new MethodReflector($this->name, $name);
    }
    return $instance;
  }

  /**
   * 
   * @param  int|null $filter
   * @return MethodReflector[]
   */
  public function getMethods($filter = null): array {
    $result = [];
    if ($filter === null) {
      $methods = parent::getMethods();
    } else {
      $methods = parent::getMethods($filter);
    }
    foreach ($methods as $method) {
      $result[$method->name] = new MethodReflector($this->name, $method->name);
    }
    return $result;
  }

  /**
   * 
   * @param  string $name the name of the property
   * @return PropertyReflector|null
   */
  public function getProperty($name): ?PropertyReflector {
    $result = null;
    if ($this->hasProperty($name)) {
      $result = new PropertyReflector($this->name, $name);
    }
    return $result;
  }

  /**
   * 
   * @param  int|null $filter
   * @return array<string, PropertyReflector>
   */
  public function getProperties($filter = null): array {
    $data = [];
    if ($filter === null) {
      $props = parent::getProperties();
    } else {
      $props = parent::getProperties($filter);
    }
    foreach ($props as $prop) {
      $data[$prop->getName()] = new PropertyReflector($this->name, $prop->name);
    }
    return $data;
  }

  public function getReflectionConstant($name): ?ClassConstantReflector {
    $result = null;
    if ($this->hasConstant($name)) {
      $result = new ClassConstantReflector($this->name, $name);
    }
    return $result;
  }

  /**
   * Returns all defined class constants, regardless of their visibility
   * 
   * @return array<string, ClassConstantReflector>
   */
  public function getReflectionConstants(?int $filter = null): array {
    $data = [];
    foreach (array_keys($this->getConstants()) as $constant) {
      $data[$constant] = new ClassConstantReflector($this->name, $constant);
    }
    return $data;
  }

  /**
   * 
   * @return boolean TRUE if traits are used, FALSE otherwise
   */
  public function usesTraits(): bool {
    return count($this->getTraitNames()) > 0;
  }

  /**
   * 
   * @return array<string, ClassReflector>
   */
  public function getTraits(): array {
    $data = [];
    foreach ($this->getTraitNames() as $traitName) {
      $data[$traitName] = new ClassReflector($traitName);
    }
    return $data;
  }

}
