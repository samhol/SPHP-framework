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
use Sphp\Config\PHPConfig;
use Sphp\Config\Exception\ConfigurationException;

/**
 * Implementation of PHPConfigurationManagerTest
 *
 * @coversDefaultClass \Sphp\Config\PHPConfig
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PHPConfigurationManagerTest extends TestCase {

  public function test1Failure(): void {
    $phpConfig = new PHPConfig();
    $this->assertSame($phpConfig, $phpConfig->setDefaultTimezone('Europe/Helsinki'));

    $phpConfig
            ->setErrorReporting(\E_ALL)
            ->setDefaultTimezone('Europe/Helsinki')
            ->setCharacterEncoding('UTF-8')
            ->insertIncludePaths('foo');
    $this->assertSame(\E_ALL, error_reporting());
    $this->assertSame('UTF-8', mb_internal_encoding());
    $this->assertSame('Europe/Helsinki', date_default_timezone_get());
  }

  public function testSetInvalidDefaultTimezone(): void {
    $phpConfig = new PHPConfig();
    $this->expectException(ConfigurationException::class);
    $phpConfig->setDefaultTimezone('foo');
    //echo date_default_timezone_get();
  }

  public function testSetInvalidCharacterEncoding(): void {
    $phpConfig = new PHPConfig();
    $this->expectException(ConfigurationException::class);
    $phpConfig->setCharacterEncoding('foo');
  }

  /**
   * @return void
   */
  public function testInsertIncludePaths(): void {
    $phpConfig = new PHPConfig();
    $paths = range('a', 'b');
    $oldPaths = $phpConfig->getIncludePaths();
    $this->assertFalse($phpConfig->containsIncludePath('a'));
    $this->assertFalse($phpConfig->containsIncludePath('b'));
    $this->assertSame($phpConfig, $phpConfig->setIncludePaths(...$paths));
    $newPaths = $phpConfig->getIncludePaths();
    $this->assertSame($paths, $newPaths);
    $this->assertEquals([], array_intersect($oldPaths, $newPaths));

    $this->assertSame($phpConfig, $phpConfig->insertIncludePaths(...$oldPaths));
    $this->assertContains('a', $phpConfig->getIncludePaths());
    $this->assertContains('b', $phpConfig->getIncludePaths());
  }

  /**
   * @return void
   */
  public function testSetIncludePaths(): void {
    $phpConfig = new PHPConfig();
    $paths = range('a', 'c');
    $this->assertSame($phpConfig, $phpConfig->setIncludePaths(...$paths));
    $this->assertEquals($paths, $phpConfig->getIncludePaths());
   // print_r($phpConfig->getIncludePaths());
  }

}
