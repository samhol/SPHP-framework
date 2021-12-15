<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection\Traits;

use Reflection;
use Sphp\Reflection\ClassReflector;

/**
 * Trait ExtensionReflectionTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait ClassMemberReflectorTrait {

  /**
   * Returns the declaring class
   * 
   * @return ClassReflector
   */
  abstract public function getDeclaringClass(): ClassReflector;

  /**
   * Returns the name of the reflected 
   * 
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  public function inNamespace(): bool {
    return $this->getDeclaringClass()->inNamespace();
  }

  /**
   * Checks if the class member is internal
   * 
   * Checks whether the function is internal, as opposed to user-defined.
   * 
   * @return bool true if it's internal, otherwise false
   */
  public function isInternal(): bool {
    return $this->getDeclaringClass()->isInternal();
  }

  /**
   * Checks if the class member user defined
   * 
   * Checks whether the function is user-defined, as opposed to internal.
   * 
   * @return bool true if it's user-defined, otherwise false
   */
  public function isUserDefined(): bool {
    return $this->getDeclaringClass()->isUserDefined();
  }

  /**
   * Returns the modifiers
   * 
   * @return int a bitfield of the access modifiers
   */
  abstract public function getModifiers();

  /**
   * Returns the modifiernames of the class member
   * 
   * @return string the modifiernames of the class member
   */
  public function getModifierNames(): string {
    return implode(' ', Reflection::getModifierNames($this->getModifiers()));
  }

}
