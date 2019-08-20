<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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
    $ini['display_errors'] = 0;
    $this->assertTrue(isset($ini['display_errors']));
    $this->assertEquals(0, $ini['display_errors']);
    $this->assertEquals(['display_errors' => 0], $ini->toArray());
    $this->assertSame($ini, $ini->set('error_reporting', E_ALL));
    return $ini;
  }

  /**
   * @depends testVariableSetting
   * 
   * @param  PHPIni $ini
   * @return PHPIni
   */
  public function testExecution(PHPIni $ini) {
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
  public function testInitAndReset(PHPIni $ini) {
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
  public function testUnset(PHPIni $ini) {
    unset($ini['display_errors']);
    unset($ini['error_reporting']);
    $this->assertFalse(isset($ini['display_errors']));
    $this->assertFalse(isset($ini['error_reporting']));
    $this->assertEquals([], $ini->toArray());
    return $ini;
  }

  public function testInvalidInit() {
    $ini = new PHPIni();
    $this->assertSame($ini, $ini->set('foo', 'bar'));
    $this->expectException(ConfigurationException::class);
    $this->assertSame($ini, $ini->init());
  }

  public function testInvalidOffsetGet() {
    $ini = new PHPIni();
    $this->expectException(ConfigurationException::class);
    $ini['foo'];
  }

}
