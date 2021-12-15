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
 * Interface ExtensionMemberReflector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ExtensionMemberReflector extends Reflector {

  /**
   * Returns the the extension which defined the member
   * 
   * @return ReflectionExtension|null the extension which defined the member
   */
  public function getExtension(): ?ReflectionExtension;

  /**
   * Returns the name of the extension which defined the member
   * 
   * @return string|null the name of the extension which defined the member
   */
  public function getExtensionName(): ?string;

  /**
   * Checks whether the reflected is internal, as opposed to user-defined
   * 
   * @return bool TRUE on success or FALSE on failure
   */
  public function isInternal(): bool;

  /**
   * Checks whether the reflected is user-defined, as opposed to internal
   * 
   * @return bool TRUE on success or FALSE on failure
   */
  public function isUserDefined(): bool;
}
