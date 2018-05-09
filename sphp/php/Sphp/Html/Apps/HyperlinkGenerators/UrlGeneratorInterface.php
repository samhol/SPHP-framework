<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

/**
 * Defines a URL string generator pointing to an online site
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface UrlGeneratorInterface {

  /**
   * Returns the URL pointing to the root of the page
   *
   * @return string the URL pointing to the API documentation
   */
  public function getRoot(): string;

  /**
   * Creates an URL string pointing to the resource
   *
   * @param  string $relative path from the root to the resource
   * @return string an URL string pointing to the resource
   */
  public function createUrl(string $relative = ''): string;
}
