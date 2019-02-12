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
use Sphp\Config\Ini;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\OutOfRangeException;

class IniTest extends TestCase {

  /**
   * @return Ini
   */
  public function testVariableSetting(): Ini {
    ini_set('display_errors', '1');
    $ini = new Ini();
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
   * @param  Ini $ini
   * @return Ini
   */
  public function testExecution(Ini $ini) {
    $f = function () {
      $this->assertEquals(0, ini_get('display_errors'));
    };

    $ini->execute($f);
    return $ini;
  }

  /**
   * @depends testExecution
   * 
   * @param  Ini $ini
   * @return Ini
   */
  public function testInitAndReset(Ini $ini) {
    $this->assertSame($ini, $ini->init());
    $this->assertEquals(0, ini_get('display_errors'));
    $this->assertSame($ini, $ini->reset());
    $this->assertEquals(1, ini_get('display_errors'));
    return $ini;
  }

  /**
   * @depends testInitAndReset
   * 
   * @param  Ini $ini
   * @return Ini
   */
  public function testUnset(Ini $ini) {
    unset($ini['display_errors']);
    unset($ini['error_reporting']);
    $this->assertFalse(isset($ini['display_errors']));
    $this->assertFalse(isset($ini['error_reporting']));
    $this->assertEquals([], $ini->toArray());
    return $ini;
  }

  public function testInvalidInit() {
    $ini = new Ini();
    $this->assertSame($ini, $ini->set('foo', 'bar'));
    $this->expectException(RuntimeException::class);
    $this->assertSame($ini, $ini->init());
  }

  public function testInvalidOffsetGet() {
    $ini = new Ini();
    $this->expectException(OutOfRangeException::class);
    $ini['foo'];
  }

}
