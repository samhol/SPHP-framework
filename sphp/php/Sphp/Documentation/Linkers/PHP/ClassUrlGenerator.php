<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

/**
 * Defines a URL string generator pointing to an online PHP API about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ClassUrlGenerator extends NamespaceApiUrlGenerator {

  /**
   * Returns the URL pointing to the API page of the given class
   *
   * @param  string $class the name of the class
   * @return string the URL pointing to the API page of the given class
   */
  public function getClassUrl(string $class): string;

  /**
   * Returns the URL pointing to the API page of the given class method
   *
   * @param  string $class the name of the class
   * @param  string $method the name of the method
   * @return string the URL pointing to the API page of the given class method
   */
  public function getClassMethodUrl(string $class, string $method): string;

  /**
   * Returns the URL pointing to the API page of the given class constant
   *
   * @param  string $class the name of the class
   * @param  string $constant the name of the constant
   * @return string the URL pointing to the API page of the given class constant
   */
  public function getClassConstantUrl(string $class, string $constant): string;

  /**
   * Returns the URL pointing to the API page of the given class property
   *
   * @param  string $class the name of the class
   * @param  string $property the name of the property
   * @return string the URL pointing to the API page of the given class property
   */
  public function getClassPropertyUrl(string $class, string $property): string;
}
