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
 * Implementation of ShutdownRegisterTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ShutdownRegisterTest extends TestCase {

  /**
   * 
   * @return ShutDownRegister
   */
  public function testConstructor(): ShutDownRegister {
    $srf = new ShutDownRegister();
    $this->assertCount(0, $srf);
    $this->assertCount(0, $srf->toArray());
    return $srf;
  }

  /**
   * @depends testConstructor
   * @param ShutDownRegister $srf
   */
  public function testCallables(ShutDownRegister $srf) {
    $f1 = function() {
      echo 'st';
    };
    $f10 = function() {
      echo 'fir';
    };
    $this->assertSame($srf, $srf->addCallable($f1, 1));
    $this->assertCount(1, $srf);
    $this->assertContains($f1, $srf);
    $this->assertContains($f1, $srf->getIterator());
    $this->assertContains($f1, $srf->toArray());
    $this->assertSame($srf, $srf->addCallable($f10, 10));
    $this->expectOutputString('first');
    $srf();
    unset($srf);
  }

}
