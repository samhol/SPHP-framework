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
 * Interface ExtensionReflectable
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ExtensionReflectable extends Reflector {

  /**
   * Returns the name of the extension which defined the member
   * 
   * @return string|null the name of the extension which defined the member
   */
  public function getExtensionName(): ?string;

  /**
   * Returns the the extension which defined the member
   * 
   * @return ExtensionReflector|null the extension which defined the member
   */
  public function getExtension(): ?ExtensionReflector;
}
