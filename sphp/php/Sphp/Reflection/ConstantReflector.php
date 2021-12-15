<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection;

use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Stdlib\Strings;
use Sphp\Reflection\Utils\PHPWords;

/**
 * Class reports information about a PHP constant
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ConstantReflector implements Reflector, ExtensionReflectable {

  use Traits\ExtensionReflectorTrait;

  private string $name;
  private string $plainName;

  /**
   * @var string[] 
   */
  private array $namespaceArray;
  private ?string $extName = null;

  /**
   * Constructor
   * 
   * @param  string $constantName a string containing the name of the constant to reflect
   * @throws ReflectionException if the constant to reflect is invalid.
   */
  public function __construct(string $constantName) {
    $this->name = ltrim($constantName, '\\');
    $this->namespaceArray = explode('\\', $constantName);
    $this->plainName = array_pop($this->namespaceArray);
    if (!defined($constantName) && !Strings::match($this->plainName, '/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/')) {
      throw new ReflectionException("Constant $constantName is not valid constant name");
    }
  }

  /**
   * 
   * @return mixed
   */
  public function getValue() {
    return constant($this->getName());
  }

  /**
   * Returns the full name of the constant
   * 
   * @return string  the full name of the constan
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the name of the constant without namespaces
   * 
   * @return string the name of the constant without namespaces
   */
  public function getShortName(): string {
    return $this->plainName;
  }

  /**
   * Returns the namespace name
   * 
   * @return string the namespace name.
   */
  public function getNamespaceName(): string {
    return implode('\\', $this->namespaceArray);
  }

  /**
   * Checks if defined in a namespace
   * 
   * @return bool true on success and false on failure
   */
  public function inNamespace(): bool {
    return count($this->namespaceArray) > 0;
  }

  /**
   * @var array
   */
  private static $constants;

  /**
   * 
   * @param  bool $reload
   * @return array
   */
  private function getConstantMap(bool $reload = false): array {
    if (!is_array(self::$constants) || $reload) {
      self::$constants = get_defined_constants(true);
    }
    return self::$constants;
  }

  private function findExt(bool $reload = false): void {
    foreach ($this->getConstantMap($reload) as $extName => $constants) {
      if (array_key_exists($this->name, $constants)) {
        $this->extName = $extName;
        break;
      }
    }
  }

  public function getExtensionName(): ?string {
    if ($this->isMagicConstant()) {
      $this->extName = null;
    } else if ($this->extName === null && defined($this->name)) {
      $this->findExt();
      if ($this->extName === null) {
        $this->findExt(true);
      }
    }
    return $this->extName === 'user' ? null : $this->extName;
  }

  public function isInternal(): bool {
    $isInternal = $this->isMagicConstant();
    if (!$isInternal && $this->isDefined()) {
      $ext = $this->getExtensionName();
      $isInternal = $ext !== null;
    }
    return $isInternal;
  }

  public function isMagicConstant(): bool {
      $names = $magicConstants = [
      '__LINE__',
      '__FILE__',
      '__DIR__',
      '__FUNCTION__',
      '__CLASS__',
      '__TRAIT__',
      '__METHOD__',
      '__NAMESPACE__'
  ];
    return in_array($this->name,$names);
  }

  public function isUserDefined(): bool {
    return !$this->isInternal() && $this->isDefined();
  }

  public function isDefined(): bool {
    return defined($this->name);
  }

  public function __toString(): string {
    return "const $this->name: " . $this->getValue();
  }

}
