<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of PHPTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PHPTest extends TestCase {

  public function testPHPVersions(): void {
    $this->assertTrue(PHP::is32bit() XOR PHP::is64bit());
    if (PHP::is32bit()) {
      $this->assertSame(32, PHP::getBitVersion());
    }
    if (PHP::is64bit()) {
      $this->assertSame(64, PHP::getBitVersion());
    }
  }

  public function testPHPConfigInstance(): void {
    $phpConf = PHP::config();
    $this->assertSame($phpConf, PHP::config());
  }

  public function testPHPIniInstance(): void {
    $fooIni = PHP::ini('foo');
    $this->assertSame($fooIni, PHP::ini('foo'));
    $this->assertNotSame($fooIni, PHP::storeIni('foo', new PHPIni()));
  }

}
