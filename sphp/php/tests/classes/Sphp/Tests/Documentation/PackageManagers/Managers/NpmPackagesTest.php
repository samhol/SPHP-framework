<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\PackageManagers\Managers;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\PackageManagers\Managers\NpmPackages;
use Sphp\Documentation\PackageManagers\Managers\NpmPackage;

/**
 * The ComposerPackagesTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NpmPackagesTest extends TestCase {

  public function testParsing(): void {
    $path = './package.json';
    $packages = new NpmPackages($path);
    $this->assertContainsOnlyInstancesOf(NpmPackage::class, $packages);
  }

}
