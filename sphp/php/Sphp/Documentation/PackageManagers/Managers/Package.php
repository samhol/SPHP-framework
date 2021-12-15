<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\PackageManagers\Managers;

/**
 * Defines a package
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Package {

  /**
   * The name of the package
   * 
   * @return string
   */
  public function getName(): string;

  /**
   * The restriction constraint
   * 
   * @return string
   */
  public function getVersion(): string;

  /**
   * The URL to homepage
   * 
   * @return string
   */
  public function getUrl(): string;
}
