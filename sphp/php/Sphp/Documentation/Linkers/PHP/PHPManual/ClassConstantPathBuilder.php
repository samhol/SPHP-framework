<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

/**
 * Class ClassConstantPathBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class ClassConstantPathBuilder {

  private function __construct() {
    
  }

  /**
   * Returns the path to the class constant documentation
   * 
   * @param string $class the name of the class
   * @param string $constant the name of the constant
   * @return string the path to the class constant documentation
   */
  public function __invoke(string $class, string $constant): string {
    if (defined("$class::$constant")) {
      $ref = new \ReflectionClassConstant($class, $constant);
      $declaringClass = $ref->getDeclaringClass()->getName();
      if ($declaringClass === \DateTimeInterface::class) {
        $c2 = 'datetime';
      } else {
        $c2 = URLUtils::parseClassName($declaringClass);
      }
      $c1 = URLUtils::parseClassName($declaringClass);
    } else {
      $c1 = URLUtils::parseClassName($class);
      $c2 = URLUtils::parseClassName($class);
    }
    $c = URLUtils::parseName($constant);
    return "class.$c1.php#$c2.constants.$c";
  }

  private static ?ClassConstantPathBuilder $instance = null;

  /**
   * Returns the factory instance
   * 
   * @return ClassConstantPathBuilder factory instance
   */
  public static function instance(): ClassConstantPathBuilder {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

}
