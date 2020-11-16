<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

/**
 * Defines a URL string generator pointing to an online PHP API
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ApiUrlGenerator extends UrlGenerator, ClassUrlGenerator {

  /**
   * Returns the URL pointing to the API page of the given namespace
   *
   * @param  string $namespace the name of the namespace
   * @return string the URL pointing to the API page of the given namespace
   */
  public function getNamespaceUrl(string $namespace): string;

  /**
   * Returns the URL pointing to the API page of the given function
   * 
   * @param string $function the name of the function
   * @return string the URL pointing to the API page of the given function
   */
  public function getFunctionUrl(string $function): string;

  /**
   * Returns the URL pointing to the API page of the given constant
   * 
   * @param string $constant the name of the constant
   * @return string the URL pointing to the API page of the given constant
   */
  public function getConstantUrl(string $constant): string;
}
