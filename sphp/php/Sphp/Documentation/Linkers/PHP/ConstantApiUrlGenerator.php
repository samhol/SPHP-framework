<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

/**
 * Defines a URL string generator pointing to an online API about a PHP constant
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ConstantApiUrlGenerator extends NamespaceApiUrlGenerator {

  /**
   * Returns the URL pointing to the API page of the given constant
   * 
   * @param string $constant the name of the constant
   * @return string the URL pointing to the API page of the given constant
   */
  public function getConstantUrl(string $constant): string;
}
