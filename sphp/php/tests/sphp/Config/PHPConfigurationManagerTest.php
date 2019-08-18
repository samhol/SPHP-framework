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
 * Implementation of PHPConfigurationManagerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PHPConfigurationManagerTest extends TestCase {

  public function test1Failure(): void {
    $phpConfMngr = new PHPConfig();
    $this->assertSame($phpConfMngr, $phpConfMngr->setDefaultTimezone('Europe/Helsinki'));

    $phpConfMngr
            ->setErrorReporting(\E_ALL)
            ->setDefaultTimezone('Europe/Helsinki')
            ->setCharacterEncoding('UTF-8')
            ->insertIncludePaths('foo');
    $this->assertSame(\E_ALL, error_reporting());
    $this->assertSame('UTF-8', mb_internal_encoding());
    $this->assertSame('Europe/Helsinki', date_default_timezone_get());
  }

  public function testSetInvalidDefaultTimezone(): void {
    $phpConfMngr = new PHPConfig();
    $this->expectException(Exception\ConfigurationException::class);
    $phpConfMngr->setDefaultTimezone('foo');
  }

  public function testSetInvalidCharacterEncoding(): void {
    $phpConfMngr = new PHPConfig();
    $this->expectException(Exception\ConfigurationException::class);
    $phpConfMngr->setCharacterEncoding('foo');
  }

  /**
   * @covers \Sphp\Config\PHPConfig::insertIncludePaths
   * @covers \Sphp\Config\PHPConfig::getIncludePaths
   * @covers \Sphp\Config\PHPConfig::containsIncludePath
   * @return void
   */
  public function testSetInvalidIncludePaths(): void {
    $phpConfMngr = new PHPConfig();
    $this->assertFalse($phpConfMngr->containsIncludePath('/fii/foo'));
    $this->assertSame($phpConfMngr, $phpConfMngr->insertIncludePaths('/fii/foo'));
    $this->assertContains('/fii/foo', $phpConfMngr->getIncludePaths());
    $this->assertTrue($phpConfMngr->containsIncludePath('/fii/foo'));
  }

}
