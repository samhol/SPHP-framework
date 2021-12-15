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

use ReflectionClassConstant;
use Sphp\Reflection\ClassReflector;
use ReflectionException as CoreReflectionException;
use Sphp\Reflection\Exceptions\ReflectionException;

/**
 * Class ClassConstantReflector
 *  
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassConstantReflector extends ReflectionClassConstant implements ClassMemberReflector {

  use Traits\ClassMemberReflectorTrait;

  private ClassReflector $caller;

  /**
   * Constructor
   * 
   * @param  string|object $class
   * @param  string $name
   * @throws ReflectionException if the given constant does not exist
   */
  public function __construct($class, string $name) {
    try {
      parent::__construct($class, $name);
      $this->caller = new ClassReflector($class);
    } catch (CoreReflectionException $ex) {
      throw new ReflectionException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->caller);
  }

  public function getCurrentClass(): ClassReflector {
    return $this->caller;
  }

  public function getDeclaringClass(): ClassReflector {
    $class = parent::getDeclaringClass()->name;
    return new ClassReflector($class);
  }

}
