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

use Sphp\Reflection\ExtensionReflector;

/**
 * Trait implementation of ExtensionReflectable
 *
 * Trait implements {@see ExtensionReflectable} interface
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 * @see ExtensionReflectable
 */
trait ExtensionReflectorTrait {

  /**
   * Returns the name of the extension which defined the member
   * 
   * @return string|null the name of the extension which defined the member
   */
  abstract public function getExtensionName(): ?string;

  /**
   * Returns the the extension which defined the member
   * 
   * @return ExtensionReflector|null the extension which defined the member
   */
  public function getExtension(): ?ExtensionReflector {
    $extName = $this->getExtensionName();
    $ext = null;
    if (is_string($extName)) {
      $ext = new ExtensionReflector($extName);
    }
    return $ext;
  }

}
