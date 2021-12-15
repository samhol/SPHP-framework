<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

/**
 * Defines a URL string generator pointing to an online API about a PHP function
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface FunctionApiUrlGenerator extends NamespaceApiUrlGenerator {

  /**
   * Returns the URL pointing to the API page of the given function
   * 
   * @param  string $function the name of the function
   * @return string the URL pointing to the API page of the given function
   */
  public function getFunctionUrl(string $function): string;
}
