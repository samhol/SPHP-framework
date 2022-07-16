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

use Iterator;
use Sphp\Stdlib\Datastructures\Arrayable;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionProperty;
use ReflectionParameter;
use ReflectionMethod;
use ReflectionFunction;
use ReflectionExtension;

/**
 * Class AbstractPHPReflecetor
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReflectorIterator implements Iterator, Arrayable {

  private static array $illegalCalls = [
      ReflectionClass::class => [
          'newInstance',
          'newInstanceArgs',
          'newInstanceWithoutConstructor',
          'getDocComment',
          'getStartLine',
          'getEndLine',
          'getFileName',
          'getInterfaceNames',
          'getReflectionConstants'
      ],
      ReflectionMethod::class => [
          'getStartLine',
          'getEndLine',
          'getFileName',
          'getDocComment',
          'getPrototype'
      ],
      ReflectionClassConstant::class => [
          'getDocComment'
      ],
      ReflectionParameter::class => [
          'isDefaultValueConstant',
          'getDefaultValue',
          'getDefaultValueConstant',
          'getDefaultValueConstantName'
      ],
      ReflectionExtension::class => [
          'getClasses',
          'info',
          'getReflectionConstants',
          'getINIEntries'
      ],
      ReflectionFunction::class => [
          'getDocComment', 'getStartLine', 'getEndLine', 'getFileName'
      ],
      ReflectionProperty::class => [
          'getDocComment'
      ],
  ];
  private object $ref;
  private ClassReflector $refRef;
  private array $data;

  /**
   * Constructor
   * 
   * @param Reflector|\Reflector $ref
   */
  public function __construct(object $ref) {
    $this->ref = $ref;
    $this->refRef = new ClassReflector($ref);
    $this->data = $this->toArray();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->refRef, $this->ref, $this->data);
  }

  protected function getSkipped(): array {
    $out = [];
    foreach (self::$illegalCalls as $type => $names) {
      if (!$this->ref instanceof $type) {
        continue;
      } else {
        $out = $names;
      }
    }
    return $out;
  }

  protected function isValidMethod(MethodReflector $method) {
    return !$method->isDeprecated() &&
            $method->isPublic() &&
            !$method->isStatic() &&
            !$method->isConstructor() &&
            !$method->isDestructor() &&
            !str_starts_with($method->name, '__') &&
            $method->getNumberOfParameters() === 0 &&
            !in_array($method->name, $this->getSkipped($this->refRef->name));
  }

  public function toArray(): array {
    $output = [];
    $output['type'] = str_replace(['Reflection', 'Reflector'], '', $this->refRef->getShortName());
    foreach ($this->refRef->getMethods() as $methodName => $method) {
      //echo "$methodName<br>";
      if (!$this->isValidMethod($method)) {
        continue;
      }
      if (str_starts_with($methodName, 'get')) {
        $key = lcfirst(substr($methodName, 3));
      } else {
        $key = $methodName;
      }
      $value = $this->parseValue($this->ref->$methodName());
      if ($value !== null) {
        $output[$key] = $value;
      }
    }
    return $output;
  }

  private function parseValue($raw) {
    $out = null;
    if (is_scalar($raw)) {
      $out = $raw;
    } else if (is_array($raw) && !empty($raw)) {
      $out = $this->parseArray($raw);
    } else if ($raw instanceof \Reflector) {
      $out = $raw->name;
    }
    return $out;
  }

  private function parseArray(array $raw): array {
    $out = [];
    foreach ($raw as $k => $value) {
      $out[$k] = $this->parseValue($value);
    }
    return $out;
  }

  public function toJson(): string {
    return json_encode($this->data, JSON_PRETTY_PRINT);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->data);
  }

  /**
   * Advance the internal pointer of the collection
   *
   * @return void
   */
  public function next(): void {
    next($this->data);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key(): mixed {
    return key($this->data);
  }

  /**
   * Rewinds the Iterator to the first element
   *
   * @return void
   */
  public function rewind(): void {
    reset($this->data);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current if iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->data);
  }

}
