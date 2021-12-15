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

use ReflectionFunction;

/**
 * Class FunctionReflector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FunctionReflector extends ReflectionFunction implements ExtensionReflectable {

  use Traits\ExtensionReflectorTrait;

  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the scope associated to the closure
   * 
   * @return ClassReflector|null the scope associated to the closure or null on failure
   */
  public function getClosureScopeClass(): ?ClassReflector {
    $classRef = parent:: getClosureScopeClass();
    $result = null;
    if ($classRef !== null) {
      $result = new ClassReflector($classRef->name);
    }
    return $result;
  }

  public function getExtensionName(): ?string {
    $name = parent::getExtensionName();
    if (!is_string($name)) {
      $name = null;
    }
    return $name;
  }

}
