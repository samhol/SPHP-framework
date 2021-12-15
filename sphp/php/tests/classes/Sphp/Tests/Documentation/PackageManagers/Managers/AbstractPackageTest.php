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
use Sphp\Documentation\PackageManagers\Managers\AbstractPackage;

/**
 * The AbstractPackageTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractPackageTest extends TestCase {

  public function testConstructor(): void {
    $name = 'a//b';
    $version = ' 1.0.0';
    $mock = $this->getMockForAbstractClass(AbstractPackage::class, [$name, $version]);
    $this->assertSame($name, $mock->getName());
    $this->assertSame($version, $mock->getVersion());
  }

}
