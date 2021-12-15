<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\PackageManagers\Managers;

use Traversable;

/**
 * Description of AbstractPackageManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface  PackageManager extends Traversable {

  /**
   * Returns information about packages used for production
   * 
   * @return iterable<Package>
   */
  public function getProductionPackages(): iterable;

  /**
   * Returns information about packages used for developement
   * 
   * @return iterable<Package>
   */
  public function getDevPackages(): iterable;
}
