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
use Sphp\Documentation\PackageManagers\Managers\ComposerPackage;

/**
 * The ComposerPackageTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ComposerPackageTest extends TestCase {

  public function testUrl(): void {
    $name = 'foo';
    $ver = 'bar';
    $package = new ComposerPackage($name, $ver);
    $this->assertSame($name, $package->getName());
    $this->assertSame($ver, $package->getVersion());
    $this->assertSame("https://packagist.org/packages/{$name}", $package->getUrl());
  }

}
