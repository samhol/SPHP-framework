<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;;

/**
 * Defines a URL string generator pointing to an online API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ApiUrlGenerator {

  /**
   * Returns the API name
   * 
   * @return string the API name
   */
  public function getApiname(): string;

  /**
   * Returns the URL pointing to the documentation root
   *
   * @return string|null the URL pointing to the documentation root
   */
  public function getRootUrl(): ?string;
}
