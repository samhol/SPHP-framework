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
use Sphp\Documentation\PackageManagers\Managers\ComposerPackages;
use Sphp\Documentation\PackageManagers\Managers\ComposerPackage;

/**
 * The ComposerPackagesTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ComposerPackagesTest extends TestCase {

  public function testParsing(): void {
    $path = './composer.json';
    $packages = new ComposerPackages($path);
    $this->assertContainsOnlyInstancesOf(ComposerPackage::class, $packages);
  }

}
