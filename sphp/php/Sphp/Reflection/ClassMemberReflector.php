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

/**
 * Defines a class member reflector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ClassMemberReflector extends Reflector {

  /**
   * Returns the declaring class
   * 
   * @return ClassReflector
   */
  public function getDeclaringClass(): ClassReflector;

  /**
   * Returns the calling class
   * 
   * @return ClassReflector
   */
  public function getCurrentClass(): ClassReflector;

  /**
   * Checks if the class member is internal
   * 
   * Checks whether the function is internal, as opposed to user-defined.
   * 
   * @return bool true if it's internal, otherwise false
   */
  public function isInternal(): bool;

  /**
   * Checks if the class member user defined
   * 
   * Checks whether the function is user-defined, as opposed to internal.
   * 
   * @return bool true if it's user-defined, otherwise false
   */
  public function isUserDefined(): bool;

  /**
   * Returns the modifiernames of the class member
   * 
   * @return string the modifiernames of the class member
   */
  public function getModifierNames(): string;
}
