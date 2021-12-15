<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config;

use PHPUnit\Framework\TestCase;
use Sphp\Config\ShutDownRegister;

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
    $this->assertCount(0, $srf->getSequence());
    $this->assertCount(0, $srf->getSequence()->toArray());
    return $srf;
  }

  /**
   * @depends testConstructor
   * 
   * @param  ShutDownRegister $srf
   * @return void
   */
  public function testCallables(ShutDownRegister $srf): void {
    $f1 = function () {
      echo 'st';
    };
    $f10 = function () {
      echo 'fir';
    };
    $this->assertSame($srf, $srf->addCallable($f1, 1));
    $this->assertCount(1, $srf->getSequence());
    $this->assertContains($f1, $srf->getSequence());
    $this->assertContains($f1, $srf->getSequence()->getIterator());
    $this->assertContains($f1, $srf->getSequence()->toArray());
    $this->assertSame($srf->getSequence(), $srf->getSequence()->addCallable($f10, 10));
    $this->expectOutputString('first');
    $srf();
    unset($srf);
  }

}
