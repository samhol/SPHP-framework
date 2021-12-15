<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config;

use PHPUnit\Framework\TestCase;
use Sphp\Config\PHPIni;
use Sphp\Config\Exception\ConfigurationException;

class IniTest extends TestCase {

  /**
   * @return PHPIni
   */
  public function testVariableSetting(): PHPIni {
    ini_set('display_errors', '1');
    $ini = new PHPIni();
    $this->assertSame($ini, $ini->set('display_errors', 0));
    $this->assertTrue($ini->contains('display_errors'));
    $this->assertSame(0, $ini->get('display_errors'));
    $this->assertSame($ini, $ini->set('error_reporting', E_ALL));
    return $ini;
  }

  /**
   * @depends testVariableSetting
   * 
   * @param  PHPIni $ini
   * @return PHPIni
   */
  public function testExecution(PHPIni $ini): PHPIni {
    $f = function () {
      $this->assertEquals(0, ini_get('display_errors'));
    };

    $ini->execute($f);
    return $ini;
  }

  /**
   * @depends testExecution
   * 
   * @param  PHPIni $ini
   * @return PHPIni
   */
  public function testInitAndReset(PHPIni $ini): PHPIni {
    $this->assertSame($ini, $ini->init());
    $this->assertEquals(0, ini_get('display_errors'));
    $this->assertSame($ini, $ini->reset());
    $this->assertEquals(1, ini_get('display_errors'));
    return $ini;
  }

  /**
   * @depends testInitAndReset
   * 
   * @param  PHPIni $ini
   * @return PHPIni
   */
  public function testUnset(PHPIni $ini): PHPIni {
    $this->assertSame($ini, $ini->remove('display_errors'));
    $this->assertSame($ini, $ini->remove('error_reporting'));
    $this->assertFalse($ini->contains('display_errors'));
    $this->assertFalse($ini->contains('error_reporting'));
    return $ini;
  }

  /**
   * @depends testInitAndReset 
   * 
   * @param  PHPIni $ini
   * @return void
   */
  public function testInvalidGet(PHPIni $ini): void {
    $this->expectException(ConfigurationException::class);
    $this->assertSame($ini, $ini->get('foo'));
  }

  public function testInvalidInit(): void {
    $ini = new PHPIni();
    $this->assertSame($ini, $ini->set('foo', 'bar'));
    $this->expectException(ConfigurationException::class);
    $this->assertSame($ini, $ini->init());
  }

}
